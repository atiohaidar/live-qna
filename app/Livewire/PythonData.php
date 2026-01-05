<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Process;

class PythonData extends Component
{
    public $pythonData = null;
    public $error = null;

    public function mount()
    {
        $this->fetchDataFromPython();
    }

    public function fetchDataFromPython()
    {
        try {
            // Kita gunakan facade Process (Laravel 10+) untuk menjalankan script python
            // Pastikan path python sesuai dengan env system Anda (biasanya 'python' atau 'python3')
            $scriptPath = base_path('scripts/data_fetcher.py');
            $pythonPath = 'C:\Users\atioh\AppData\Local\Programs\Python\Python311\python.exe';
            
            $result = Process::run("\"{$pythonPath}\" \"{$scriptPath}\"");

            if ($result->successful()) {
                $this->pythonData = json_decode($result->output(), true);
            } else {
                $this->error = "Gagal menjalankan script Python: " . $result->errorOutput();
            }
        } catch (\Exception $e) {
            $this->error = "Terjadi kesalahan: " . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.python-data')
            ->layout('components.layouts.app')
            ->title('Python Integration Demo');
    }
}

