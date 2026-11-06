<?php

use Illuminate\Console\Command;
use Statamic\Console\NullConsole;

/**
 * Prints the setup steps for the Alt addons a new site was installed with.
 *
 * Statamic runs this after the chosen modules are installed but does not say
 * which were chosen, so the site's composer.json is read instead.
 */
class StarterKitPostInstall
{
    /**
     * Each addon's name and setup steps, keyed by its Composer package.
     *
     * @var array<string, array{0: string, 1: list<string>}>
     */
    protected array $steps = [
        'alt-design/alt-akismet' => ['Alt Akismet', [
            'Add the Akismet key to .env as ALT_AKISMET_API_KEY.',
        ]],
        'alt-design/alt-riffraff' => ['RiffRaff', [
            'Create a RiffRaff account at https://riff-raff.dev/register if the client does not have one.',
            'On the server, run: php please riffraff:connect "Site name"',
            'A manager of the RiffRaff team enters the code it prints at https://riff-raff.dev/connect. Check it worked with: php please riffraff:status',
            'Add content/riffraff to .gitignore, as held submissions contain what visitors typed.',
        ]],
        'alt-design/alt-google-maps' => ['Alt Google Maps', [
            'For OpenStreetMap, which needs no key, set GOOGLE_MAPS_PROVIDER=osm in .env.',
            'For Google Maps, set GOOGLE_MAPS_PROVIDER=google and GOOGLE_MAPS_API_KEY in .env.',
            'The default location and map style are under Alt Tools > Editing > Alt Google Maps in the control panel.',
        ]],
        'alt-design/alt-live-editor' => ['Alt Live Editor', [
            'Wrap each page builder row in {{ alt_live_editor:row }} so rows can be edited from Live Preview. Text fields work without it.',
        ]],
        'alt-design/alt-tabs' => ['Alt Tabs', [
            'Nothing to set up. Add a Tab field to a blueprint or set to start a tab.',
        ]],
    ];

    /**
     * Print the steps for every addon in the site's composer.json.
     */
    public function handle(Command|NullConsole $console): void
    {
        $steps = array_intersect_key($this->steps, array_flip($this->requiredPackages()));

        if ($steps === []) {
            return;
        }

        $console->newLine();
        $console->info('Alt addon setup');

        foreach ($steps as [$name, $lines]) {
            $console->newLine();
            $console->line("<comment>{$name}</comment>");

            foreach ($lines as $line) {
                $console->line("  - {$line}");
            }
        }

        $console->newLine();
    }

    /**
     * The packages the site's composer.json requires.
     *
     * @return list<string>
     */
    protected function requiredPackages(): array
    {
        $composer = json_decode((string) file_get_contents(base_path('composer.json')), true);

        return array_keys($composer['require'] ?? []);
    }
}
