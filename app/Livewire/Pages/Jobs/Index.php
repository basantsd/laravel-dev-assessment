<?php
namespace App\Livewire\Pages\Jobs;

use App\Models\JobPost;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use Livewire\Component;
use Storage;

class Index extends Component
{
    public array $jobs = [];

    public function mount()
    {
        $this->fetchJobs();
    }

    public function fetchJobs()
    {
        $this->jobs = JobPost::with('skills:id,name')->get()->toArray();
    }

    public function deleteJobPost($id)
    {
        $job = JobPost::find($id);
        if ($job) {
            if($job->delete()){
                Storage::disk('public')->delete($job->logo);
            }
            session()->flash('success', 'Job Post Deleted Successfully.');
        }
        return redirect()->route('admin.jobs.index');
    }

    public function render()
    {
        return view('livewire.pages.jobs.index');
    }
}
