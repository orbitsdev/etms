<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class ViewCourse extends Component
{

    public  $record;
    public function render($record)
    {

        $this->record = Course::withRelation()->findOrFail($record);
        return view('livewire.view-course');
    }
}
