<?php

namespace Kanboard\Plugin\StudentProjectTheme;

use Kanboard\Core\Plugin\Base;

class Plugin extends Base
{
    public function initialize()
    {
        $this->template->setTemplateOverride('project_header/search', 'StudentProjectTheme:project_header/search');
        $this->template->setTemplateOverride('project_header/views', 'StudentProjectTheme:project_header/views');
        $this->template->setTemplateOverride('auth/index', 'StudentProjectTheme:auth/index');
        $this->hook->on('template:layout:top', array('template' => 'StudentProjectTheme:layout/banner'));
        $this->hook->on('template:layout:css', array('template' => 'plugins/StudentProjectTheme/Assets/css/student-project-theme.css'));
    }

    public function getPluginName()
    {
        return 'StudentProjectTheme';
    }

    public function getPluginDescription()
    {
        return t('Adds lightweight branding for the student project Kanboard demo.');
    }

    public function getPluginAuthor()
    {
        return 'OpenAI Codex';
    }

    public function getPluginVersion()
    {
        return '0.1.0';
    }

    public function getCompatibleVersion()
    {
        return '>=1.2.0';
    }
}
