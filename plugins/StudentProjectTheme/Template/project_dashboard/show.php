<section id="main">
    <?= $this->projectHeader->render($project, 'ProjectDashboardController', 'show', false, 'StudentProjectTheme') ?>

    <div class="page-header student-dashboard-header">
        <div>
            <h2>Dashboard tiến độ</h2>
            <p class="student-dashboard-header__subtitle">Theo dõi nhanh tình hình công việc của nhóm sinh viên trong dự án hiện tại.</p>
        </div>
        <div class="student-dashboard-header__meta">
            <span class="student-dashboard-badge">Báo cáo nhanh</span>
            <span class="student-dashboard-badge student-dashboard-badge--soft">Không dùng biểu đồ phức tạp</span>
        </div>
    </div>

    <div class="student-dashboard-grid">
        <?php foreach ($metrics as $metric): ?>
            <article class="student-dashboard-card student-dashboard-card--<?= $this->text->e($metric['tone']) ?>">
                <p class="student-dashboard-card__label"><?= $this->text->e($metric['label']) ?></p>
                <strong class="student-dashboard-card__value"><?= $this->text->e($metric['value']) ?></strong>
                <p class="student-dashboard-card__description"><?= $this->text->e($metric['description']) ?></p>
            </article>
        <?php endforeach ?>
    </div>

    <div class="student-dashboard-panel">
        <div class="student-dashboard-panel__header">
            <div>
                <h3>Công việc theo thành viên</h3>
                <p>Phân bổ số công việc đang mở theo từng thành viên để nhóm nhìn nhanh mức độ phụ trách hiện tại.</p>
            </div>
        </div>

        <?php if (empty($member_metrics)): ?>
            <p class="alert">Chưa có đủ dữ liệu để hiển thị phân bổ công việc theo thành viên.</p>
        <?php else: ?>
            <table class="student-dashboard-table">
                <thead>
                    <tr>
                        <th>Thành viên</th>
                        <th>Số công việc mở</th>
                        <th>Tỷ lệ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($member_metrics as $metric): ?>
                        <tr>
                            <td><?= $this->text->e($metric['user']) ?></td>
                            <td><?= $this->text->e($metric['nb_tasks']) ?></td>
                            <td><?= $this->text->e($metric['percentage']) ?>%</td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
</section>
