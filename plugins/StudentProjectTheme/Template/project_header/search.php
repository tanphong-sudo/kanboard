<div class="filter-box">
    <form method="get" action="<?= $this->url->dir() ?>" class="search">
        <?= $this->form->hidden('controller', $filters) ?>
        <?= $this->form->hidden('action', $filters) ?>
        <?= $this->form->hidden('plugin', $filters) ?>
        <?= $this->form->hidden('project_id', $filters) ?>

        <div class="input-addon">
            <?= $this->form->text('search', $filters, array(), array('placeholder="'.t('Filter').'"', 'aria-label="'.t('Filter').'"'), 'input-addon-field') ?>
            <div class="input-addon-item">
                <?= $this->render('app/filters_helper', array('reset' => 'status:open', 'project' => $project)) ?>
            </div>

            <?php if (isset($custom_filters_list) && ! empty($custom_filters_list)): ?>
            <div class="input-addon-item">
                <div class="dropdown">
                    <a href="#" class="dropdown-menu dropdown-menu-link-icon" title="<?= t('Custom filters') ?>" aria-label="<?= t('Custom filters') ?>"><i class="fa fa-bookmark fa-fw"></i><i class="fa fa-caret-down"></i></a>
                    <ul>
                        <?php foreach ($custom_filters_list as $filter): ?>
                            <li><a href="#" class="filter-helper" data-<?php if ($filter['append']): ?><?= 'append-' ?><?php endif ?>filter='<?= $this->text->e($filter['filter']) ?>'><?= $this->text->e($filter['name']) ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <?php endif ?>

            <?php if (isset($users_list)): ?>
            <div class="input-addon-item">
                <div class="dropdown">
                    <a href="#" class="dropdown-menu dropdown-menu-link-icon" title="<?= t('User filters') ?>" aria-label="<?= t('Custom filters') ?>"><i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i></a>
                    <ul>
                        <li><a href="#" class="filter-helper" data-unique-filter="assignee:nobody"><?= t('Not assigned') ?></a></li>
                        <li><a href="#" class="filter-helper" data-unique-filter="assignee:anybody"><?= t('Assigned') ?></a></li>
                        <?php foreach ($users_list as $user): ?>
                            <li><a href="#" class="filter-helper" data-unique-filter='assignee:"<?= $this->text->e($user) ?>"'><?= $this->text->e($user) ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <?php endif ?>

            <?php if (isset($categories_list) && ! empty($categories_list)): ?>
            <div class="input-addon-item">
                <div class="dropdown">
                    <a href="#" class="dropdown-menu dropdown-menu-link-icon" title="<?= t('Category filters') ?>" aria-label="<?= t('Category filters') ?>"><i class="fa fa-folder-open fa-fw"></i><i class="fa fa-caret-down"></i></a>
                    <ul>
                        <li><a href="#" class="filter-helper" data-unique-filter="category:none"><?= t('No category') ?></a></li>
                        <?php foreach ($categories_list as $category): ?>
                            <li><a href="#" class="filter-helper" data-unique-filter='category:"<?= $this->text->e($category) ?>"'><?= $this->text->e($category) ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <?php endif ?>
        </div>

    </form>

    <div class="student-quick-filters">
        <div class="student-quick-filters__label">Bộ lọc nhanh</div>
        <div class="student-quick-filters__list">
            <?= $this->url->link('Công việc của tôi', 'TaskListController', 'show', array('project_id' => $project['id'], 'search' => 'status:open assignee:me'), false, 'student-quick-filters__chip') ?>
            <?= $this->url->link('Công việc quá hạn', 'TaskListController', 'show', array('project_id' => $project['id'], 'search' => 'status:open due:yesterday'), false, 'student-quick-filters__chip student-quick-filters__chip--peach') ?>
            <?= $this->url->link('Công việc sắp đến hạn', 'TaskListController', 'show', array('project_id' => $project['id'], 'search' => 'status:open due:tomorrow'), false, 'student-quick-filters__chip student-quick-filters__chip--lavender') ?>
            <?= $this->url->link('Công việc chưa có người phụ trách', 'TaskListController', 'show', array('project_id' => $project['id'], 'search' => 'status:open assignee:nobody'), false, 'student-quick-filters__chip student-quick-filters__chip--sky') ?>
            <?= $this->url->link('Công việc đã hoàn thành', 'TaskListController', 'show', array('project_id' => $project['id'], 'search' => 'column:"Hoàn thành"'), false, 'student-quick-filters__chip student-quick-filters__chip--mint') ?>
        </div>
    </div>
</div>
