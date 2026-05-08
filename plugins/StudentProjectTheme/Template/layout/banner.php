<?php
$rootLogoPath = dirname(__DIR__, 4).'/assets/img/01_logobachkhoatoi.png';
$pluginLogoPath = dirname(__DIR__, 2).'/Assets/img/bach-khoa-logo.png';
$logoUrl = '';
$logoAlt = 'Bach Khoa logo';

if (file_exists($rootLogoPath)) {
    $logoUrl = $this->url->dir().'assets/img/01_logobachkhoatoi.png';
} elseif (file_exists($pluginLogoPath)) {
    $logoUrl = $this->url->dir().'plugins/StudentProjectTheme/Assets/img/bach-khoa-logo.png';
}
?>
<div class="student-project-banner">
    <div class="student-project-banner__inner">
        <div class="student-project-banner__brand">
            <?php if ($logoUrl !== ''): ?>
                <img src="<?= $this->text->e($logoUrl) ?>" alt="<?= $this->text->e($logoAlt) ?>" class="student-project-banner__logo">
            <?php endif ?>
            <div class="student-project-banner__content">
                <div class="student-project-banner__eyebrow">Group 03 · Trường Đại học Bách Khoa</div>
                <div class="student-project-banner__title">Kanboard Nhóm 03</div>
                <div class="student-project-banner__subtitle">Hệ thống quản lý công việc nhóm sinh viên</div>
                <div class="student-project-banner__context">Bài tập lớn môn Quản lý Dự án cho Kỹ sư</div>
            </div>
        </div>

        <div class="student-project-banner__chips" aria-hidden="true">
            <span class="student-project-banner__chip student-project-banner__chip--sky">Kanban</span>
            <span class="student-project-banner__chip student-project-banner__chip--mint">Teamwork</span>
            <span class="student-project-banner__chip student-project-banner__chip--peach">Deadline</span>
        </div>
    </div>
</div>
