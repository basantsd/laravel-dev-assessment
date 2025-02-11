<?php

namespace App\Livewire\Pages\Jobs;

use App\Models\JobPost;
use App\Models\Skill;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $id, $jobTitle, $description, $experience, $salary, $location, $extraInfo, $companyName, $selectedSkills = [];
    public $logo,$logo_url, $existingLogo;


    public function mount($id = null)
    {
        if ($id) {
            $job = JobPost::findOrFail($id);
            $this->id = $job->id;
            $this->jobTitle = $job->title;
            $this->description = $job->description;
            $this->experience = $job->experience;
            $this->salary = $job->salary;
            $this->location = $job->location;
            $this->extraInfo = $job->extra_info;
            $this->companyName = $job->company_name;
            $this->selectedSkills = $job->skills->pluck('id')->toArray();
            $this->existingLogo = $job->logo;
            $this->logo_url = $job->logo_url;
        }
    }

    public function save()
    {
        $validatedData = $this->validate([
            'jobTitle' => 'required|string|max:255',
            'description' => 'required|string',
            'experience' => 'required|string|max:50',
            'salary' => 'required|string|max:50',
            'location' => 'required|string|max:100',
            'extraInfo' => 'required|string|max:255',
            'companyName' => 'required|string|max:255',
            'selectedSkills' => 'required|array|min:1',
            'logo' => 'nullable|image|max:2048',
        ]);

        $jobPost = JobPost::findOrFail($this->id);
        $logoPath = $this->logo ? $this->logo->store('company-logos', 'public') : $jobPost->logo;

        $jobPost->update([
            'title' => $this->jobTitle,
            'description' => $this->description,
            'experience' => $this->experience,
            'salary' => $this->salary,
            'location' => $this->location,
            'extra_info' => $this->extraInfo,
            'company_name' => $this->companyName,
            'logo' => $logoPath
        ]);

        $jobPost->skills()->sync($this->selectedSkills);

        session()->flash('success', 'Job post updated successfully!');
        return redirect()->route('admin.jobs.index');
    }


    public function render()
    {
        $skills = Skill::all()->toArray(); // Load all skills
        return view('livewire.pages.jobs.update',['skills'=>$skills]);
    }
}
