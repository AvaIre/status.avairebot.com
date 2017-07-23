<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EnforceMixUrlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enforce-mix-url';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enforces full uri paths for the mix manifest';

    /**
     * The full-url the assets should point to.
     *
     * @var string
     */
    protected $url;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->url = config('app.url');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (! $this->getMixManifestFile()) {
            return $this->error('Couldn\'t find a mix-manifest.json file in the public directory, ending command process.');
        }

        $manifest = json_decode(file_get_contents($this->getMixManifestFile()), true);

        array_walk($manifest, [$this, 'formatManifest']);

        file_put_contents($this->getMixManifestFile(), json_encode($manifest, JSON_PRETTY_PRINT));

        return $this->info('New manifest file saved successfully.');
    }

    /**
     * Formats the values of the manifest array.
     *
     * @param  string &$item
     * @return void
     */
    protected function formatManifest(&$item)
    {
        if (! starts_with($item, $this->url)) {
            $item = str_finish($this->url, $item);
        }
    }

    /**
     * Returnss the manifest file path.
     *
     * @return string
     */
    protected function getMixManifestFile()
    {
        return public_path('mix-manifest.json');
    }
}
