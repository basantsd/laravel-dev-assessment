<?php

namespace App\Livewire\Pages\Jobs;

use App\Models\JobPost;
use App\Models\Skill;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $jobTitle, $description, $experience, $salary, $location, $extraInfo, $logo, $companyName, $selectedSkills = [];

    public function save()
    {
        try {
            $this->validate([
                'jobTitle' => 'required|string|max:255',
                'description' => 'required|string',
                'experience' => 'required|string|max:50',
                'salary' => 'required|string|max:50',
                'location' => 'required|string|max:100',
                'extraInfo' => 'required|string|max:255',
                'companyName' => 'required|string|max:255',
                'selectedSkills' => 'required|array|min:1',
                'logo' => 'required|image|max:2048',
            ]);

            $logoPath = $this->logo ? $this->logo->store('company-logos', 'public') : null;

            $jobPost = JobPost::create([
                'title' => $this->jobTitle,
                'description' => $this->description,
                'experience' => $this->experience,
                'salary' => $this->salary,
                'location' => $this->location,
                'extra_info' => $this->extraInfo,
                'company_name' => $this->companyName,
                'logo' => $logoPath,
            ]);

            $jobPost->skills()->attach($this->selectedSkills);

            session()->flash('success', 'Job post created successfully!');
            $this->reset();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function render()
    {
        $skills = Skill::all()->toArray();
        return view('livewire.pages.jobs.create', ['skills' => $skills]);
    }
}
