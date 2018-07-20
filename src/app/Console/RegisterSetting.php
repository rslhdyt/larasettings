<?php

namespace Rslhdyt\LaraSettings\Console;

use Illuminate\Console\Command;
use Rslhdyt\LaraSettings\Models\Setting;

class RegisterSetting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:set {--key : Key of configuration settings} {--label : Label of configuration settings} {--group : Group of settings}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set setting configuration, if key is not present it will create new settings';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $options = $this->options();

        if (empty($options['key'])) {
            $options['key'] = $this->ask('Key name of configuration?');
        }
        
        if (empty($options['label'])) {
            $options['label'] = $this->ask('Label of configuration?');
        }
        
        if (empty($options['groups'])) {
            $options['groups'] = $this->ask('Group of configuration?', 'default');
        }

        $setting = Setting::firstOrNew([
            'key' => $options['key']
        ]);

        $setting->label = $options['label'];
        $setting->groups = $options['groups'];
        $save = $setting->save();

        if ($save) {
            $this->info('Settings saved.');
        }
    }
}
