<?php

namespace App\Imports;

use App\Models\Task;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Throwable;

class TasksImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, WithBatchInserts, WithChunkReading
{
    use SkipsErrors;
    
    private $rows = 0;
    private $userId;
    private $defaultStatus = 1; // Default to pending status
    
    public function __construct()
    {
        $this->userId = Auth::id();
    }
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        ++$this->rows;
        
        // Flexible column name mapping
        $title = $this->getColumnValue($row, ['title', 'task_name', 'task']);
        $description = $this->getColumnValue($row, ['description', 'task_description', 'desc']);
        $status = $this->getColumnValue($row, ['status', 'task_status'], $this->defaultStatus);
        $dueDate = $this->getColumnValue($row, ['due_date', 'due', 'target_date'], Carbon::now()->addWeek());
        
        // Parse and format dates
        try {
            $dueDate = Carbon::parse($dueDate)->format('Y-m-d');
        } catch (\Exception $e) {
            $dueDate = Carbon::now()->addWeek()->format('Y-m-d');
        }
        
        return new Task([
            'title'         => $title,
            'description'   => $description,
            'status'        => $status,
            'due_date'      => $dueDate,
            'user_id'      => $this->userId,
            'order'         => Task::where('user_id', $this->userId)->max('order') + 1,
     
        ]);
    }

    /**
     * Get value from row with flexible column names
     */
    private function getColumnValue(array $row, array $possibleKeys, $default = null)
    {
        foreach ($possibleKeys as $key) {
            if (isset($row[$key])) {
                return $row[$key];
            }
        }
        return $default;
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [
            '*.title' => 'required|string|max:255',
            '*.description' => 'nullable|string',
            '*.status' => 'nullable|in:1,2',
            '*.due_date' => 'nullable|date',
        ];
    }

    /**
     * Custom validation messages
     */
    public function customValidationMessages()
    {
        return [
            'title.required' => 'The title field is required for row :attribute',
            'title.string' => 'The title must be a string for row :attribute',
            'title.max' => 'The title may not be greater than 255 characters for row :attribute',
            'status.in' => 'The status must be either 1 (pending) or 2 (completed) for row :attribute',
            'due_date.date' => 'The due date must be a valid date for row :attribute',
        ];
    }

    /**
     * Handle import errors
     */
    public function onError(Throwable $e)
    {
        Log::error('Task Import Error: '.$e->getMessage());
    }
    
    /**
     * Get the count of successfully imported rows
     */
    public function getRowCount(): int
    {
        return $this->rows;
    }
    
    /**
     * Configure batch inserts for better performance
     */
    public function batchSize(): int
    {
        return 500;
    }
    
    /**
     * Configure chunk reading for memory efficiency
     */
    public function chunkSize(): int
    {
        return 500;
    }
}