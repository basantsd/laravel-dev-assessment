<?php

namespace App\Livewire\Pages\Skills;

use App\Models\Skill;
use Livewire\Component;

class Index extends Component
{

    public $skills, $name, $skill_id;

    public $isEditing = false;

    protected $rules = [
        'name' => 'required|min:2'
    ];

    public function mount()
    {
        $this->skills = Skill::all();
    }

    public function save()
    {
        $this->validate();

        Skill::create(['name' => $this->name]);

        $this->resetForm();
        $this->refreshSkills();
    }

    public function edit($id)
    {
        $skill = Skill::findOrFail($id);
        $this->skill_id = $skill->id;
        $this->name = $skill->name;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();

        $skill = Skill::findOrFail($this->skill_id);
        $skill->update(['name' => $this->name]);

        $this->resetForm();
        $this->refreshSkills();
    }

    public function delete($id)
    {
        Skill::findOrFail($id)->delete();
        $this->refreshSkills();
    }

    private function refreshSkills()
    {
        $this->skills = Skill::all();
    }

    private function resetForm()
    {
        $this->name = '';
        $this->skill_id = null;
        $this->isEditing = false;
    }

    public function render()
    {
        return view('livewire.pages.skills.index');
    }
}
