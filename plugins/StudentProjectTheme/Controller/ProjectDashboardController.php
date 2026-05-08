<?php

namespace Kanboard\Plugin\StudentProjectTheme\Controller;

use Kanboard\Controller\BaseController;
use Kanboard\Model\TaskModel;

class ProjectDashboardController extends BaseController
{
    public function show()
    {
        $project = $this->getProject();
        $columns = $this->columnModel->getAll($project['id']);
        $inProgressColumns = $this->findInProgressColumns($columns);
        $completedColumns = $this->findCompletedColumns($columns);
        $inProgressCount = 0;
        $completedCount = $this->taskFinderModel->countByProjectId($project['id'], array(TaskModel::STATUS_CLOSED));

        foreach ($inProgressColumns as $column) {
            $inProgressCount += $this->taskFinderModel->countByColumnId($project['id'], $column['id'], array(TaskModel::STATUS_OPEN));
        }

        foreach ($completedColumns as $column) {
            $completedCount += $this->taskFinderModel->countByColumnId($project['id'], $column['id'], array(TaskModel::STATUS_OPEN));
        }

        $openCount = $this->taskFinderModel->countByProjectId($project['id'], array(TaskModel::STATUS_OPEN));

        if (empty($inProgressColumns)) {
            $inProgressCount = $openCount;
        }

        $this->response->html($this->helper->layout->app('StudentProjectTheme:project_dashboard/show', array(
            'project' => $project,
            'title' => 'Dashboard tiến độ',
            'metrics' => array(
                array(
                    'label' => 'Tổng số công việc',
                    'value' => $this->taskFinderModel->countByProjectId($project['id']),
                    'tone' => 'blue',
                    'description' => 'Toàn bộ công việc đang mở và đã hoàn thành trong dự án.',
                ),
                array(
                    'label' => 'Công việc đang làm',
                    'value' => $inProgressCount,
                    'tone' => 'mint',
                    'description' => empty($inProgressColumns)
                        ? 'Đang dùng số công việc mở vì chưa tìm thấy cột Đang làm trong dự án.'
                        : 'Đếm theo cột: '.$this->formatColumnNames($inProgressColumns),
                ),
                array(
                    'label' => 'Công việc đã hoàn thành',
                    'value' => $completedCount,
                    'tone' => 'peach',
                    'description' => empty($completedColumns)
                        ? 'Các công việc đã đóng hoặc hoàn tất.'
                        : 'Đếm theo cột: '.$this->formatColumnNames($completedColumns).' và các công việc đã đóng.',
                ),
                array(
                    'label' => 'Công việc quá hạn',
                    'value' => count($this->taskFinderModel->getOverdueTasksByProject($project['id'])),
                    'tone' => 'lavender',
                    'description' => 'Các công việc mở đã vượt quá hạn xử lý.',
                ),
            ),
            'member_metrics' => $this->userDistributionAnalytic->build($project['id']),
            'in_progress_columns' => $inProgressColumns,
        )));
    }

    private function findInProgressColumns(array $columns)
    {
        $matches = array();
        $expectedTitles = array(
            'dang lam',
            'đang làm',
            'work in progress',
            'in progress',
            'doing',
        );

        foreach ($columns as $column) {
            if (in_array($this->normalizeColumnTitle($column['title']), $expectedTitles, true)) {
                $matches[] = $column;
            }
        }

        return $matches;
    }

    private function findCompletedColumns(array $columns)
    {
        $matches = array();
        $expectedTitles = array(
            'hoàn thành',
            'hoan thanh',
            'done',
            'completed',
            'complete',
        );

        foreach ($columns as $column) {
            if (in_array($this->normalizeColumnTitle($column['title']), $expectedTitles, true)) {
                $matches[] = $column;
            }
        }

        return $matches;
    }

    private function formatColumnNames(array $columns)
    {
        $names = array();

        foreach ($columns as $column) {
            $names[] = $column['title'];
        }

        return implode(', ', $names);
    }

    private function normalizeColumnTitle($title)
    {
        $value = trim($title);
        $value = function_exists('mb_strtolower') ? mb_strtolower($value, 'UTF-8') : strtolower($value);
        return preg_replace('/\s+/', ' ', $value);
    }
}
