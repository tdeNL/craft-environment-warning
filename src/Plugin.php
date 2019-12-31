<?php

namespace tde\craft\environmentwarning;

use craft\events\RegisterTemplateRootsEvent;
use craft\i18n\PhpMessageSource;
use craft\web\View;
use tde\craft\environmentwarning\services\GitService;
use yii\base\Event;

/**
 * @property GitService $gitService
 *
 * @package tde\craft\environmentwarning
 */
class Plugin extends \craft\base\Plugin
{
    /**
     * @var self
     */
    public static $instance;

    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();
        self::$instance = $this;

        $this->setComponents([
            'gitService' => GitService::class,
        ]);

        $this->_registerTranslations();
        $this->_registerTemplateRoots();
        $this->_registerHooks();
    }

    /**
     * Register our translations
     */
    protected function _registerTranslations()
    {
        \Craft::$app->i18n->translations['environment-warning'] = [
            'class' => PhpMessageSource::class,
            'sourceLanguage' => 'en-US',
            'basePath' => __DIR__ . '/translations',
            'allowOverrides' => true,
        ];
    }

    /**
     * Register our template roots
     */
    protected function _registerTemplateRoots()
    {
        Event::on(
            View::class,
            View::EVENT_REGISTER_SITE_TEMPLATE_ROOTS,
            function (RegisterTemplateRootsEvent $event) {
                $event->roots = array_merge($event->roots, [
                    'environment-warning' =>  __DIR__ . '/templates',
                ]);
            }
        );
    }

    /**
     * Register our Twig hooks
     */
    protected function _registerHooks()
    {
        \Craft::$app->view->hook('show-environment-warning', function(array &$context) {
            if (getenv('ENVIRONMENT_WARNING_ENABLED')) {
                return \Craft::$app->getView()->renderTemplate('environment-warning/flash', [
                    'productionUrl' => getenv('ENVIRONMENT_WARNING_PRODUCTION_URL'),
                    'branchName' => self::getInstance()->gitService->getCurrentBranchName()
                ]);
            }

            return '';
        });
    }
}
