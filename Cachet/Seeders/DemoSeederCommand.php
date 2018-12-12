<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Cachet\Console\Commands;

use CachetHQ\Cachet\Models\Action;
use CachetHQ\Cachet\Models\Component;
use CachetHQ\Cachet\Models\ComponentGroup;
use CachetHQ\Cachet\Models\Incident;
use CachetHQ\Cachet\Models\IncidentTemplate;
use CachetHQ\Cachet\Models\IncidentUpdate;
use CachetHQ\Cachet\Models\Metric;
use CachetHQ\Cachet\Models\MetricPoint;
use CachetHQ\Cachet\Models\Schedule;
use CachetHQ\Cachet\Models\User;
use CachetHQ\Cachet\Settings\Repository;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Symfony\Component\Console\Input\InputOption;

/**
 * This is the demo seeder command.
 *
 * @author James Brooks <james@alt-three.com>
 */
class DemoSeederCommand extends Command
{
    use ConfirmableTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cachet:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds Cachet with demo data';

    /**
     * The settings repository.
     *
     * @var \CachetHQ\Cachet\Settings\Repository
     */
    protected $settings;

    /**
     * The number of loops
     *
     * @var int
     */
    protected $numberOfLoops = 20000;

    /**
     * Create a new demo seeder command instance.
     *
     * @param \CachetHQ\Cachet\Settings\Repository $settings
     *
     * @return void
     */
    public function __construct(Repository $settings)
    {
        parent::__construct();

        $this->settings = $settings;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->confirmToProceed()) {
            return;
        }

        $this->seedUsers();
        $this->seedActions();
        $this->seedComponentGroups();
        $this->seedComponents();
        $this->seedIncidents();
        $this->seedIncidentTemplates();
        $this->seedMetricPoints();
        $this->seedMetrics();
        $this->seedSchedules();
        $this->seedSettings();
        $this->seedSubscribers();

        $this->info('Database seeded with demo data successfully!');
    }

    /**
     * Seed the actions table.
     *
     * @return void
     */
    protected function seedActions()
    {
        Action::truncate();
    }

    /**
     * Seed the component groups table.
     *
     * @return void
     */
    protected function seedComponentGroups()
    {
        $defaultGroups = [
            [
                'name'      => 'Websites',
                'order'     => 1,
                'collapsed' => 0,
                'visible'   => ComponentGroup::VISIBLE_AUTHENTICATED,
            ], [
                'name'      => 'Alt Three',
                'order'     => 2,
                'collapsed' => 1,
                'visible'   => ComponentGroup::VISIBLE_GUEST,
            ],
        ];

        ComponentGroup::truncate();

        foreach ($defaultGroups as $group) {
            ComponentGroup::create($group);
        }
    }

    /**
     * Seed the components table.
     *
     * @return void
     */
    protected function seedComponents()
    {
        $defaultComponents = [
            [
                'name'        => 'API',
                'description' => 'Used by third-parties to connect to us',
                'status'      => 1,
                'order'       => 0,
                'group_id'    => 0,
                'link'        => '',
            ], [
                'name'        => 'Documentation',
                'description' => 'Kindly powered by Readme.io',
                'status'      => 1,
                'order'       => 0,
                'group_id'    => 1,
                'link'        => 'https://docs.cachethq.io',
            ], [
                'name'        => 'Website',
                'description' => '',
                'status'      => 1,
                'order'       => 0,
                'group_id'    => 1,
                'link'        => 'https://cachethq.io',
            ], [
                'name'        => 'Blog',
                'description' => 'The Alt Three Blog.',
                'status'      => 1,
                'order'       => 0,
                'group_id'    => 2,
                'link'        => 'https://blog.alt-three.com',
            ], [
                'name'        => 'StyleCI',
                'description' => 'The PHP Coding Style Service.',
                'status'      => 1,
                'order'       => 1,
                'group_id'    => 2,
                'link'        => 'https://styleci.io',
            ], [
                'name'        => 'GitHub',
                'description' => '',
                'status'      => 1,
                'order'       => 0,
                'group_id'    => 0,
                'link'        => 'https://github.com/CachetHQ/Cachet',
            ],
        ];

        Component::truncate();

        for ($i = 0; $i < $this->numberOfLoops ; $i++) {
            $random = random_int(0, 5);
            Component::create($defaultComponents[$random]);
        }
    }

    /**
     * Seed the incidents table.
     *
     * @return void
     */
    protected function seedIncidents()
    {
        $incidentMessage = <<<'EINCIDENT'
# Of course it does!

What kind of web application doesn't these days?

## Headers are fun aren't they

It's _exactly_ why we need Markdown. For **emphasis** and such.
EINCIDENT;

        $defaultIncidents = [
            [
                'name'         => 'Our monkeys aren\'t performing',
                'message'      => 'We\'re investigating an issue with our monkeys not performing as they should be.',
                'status'       => Incident::INVESTIGATING,
                'component_id' => 0,
                'visible'      => 1,
                'stickied'     => false,
                'user_id'      => 1,
                'occurred_at'  => Carbon::now(),
            ],
            [
                'name'         => 'This is an unresolved incident',
                'message'      => 'Unresolved incidents are left without a **Fixed** update.',
                'status'       => Incident::INVESTIGATING,
                'component_id' => 0,
                'visible'      => 1,
                'stickied'     => false,
                'user_id'      => 1,
                'occurred_at'  => Carbon::now(),
            ],
        ];
        Incident::truncate();
        IncidentUpdate::truncate();
        for ($i = 0; $i < $this->numberOfLoops ; $i++) {
            $random = random_int(0, 1);
            $incident = Incident::create($defaultIncidents[$random]);

            $this->seedIncidentUpdates($incident);
        }
    }

    /**
     * Seed the incident templates table.
     *
     * @return void
     */
    protected function seedIncidentTemplates()
    {
        IncidentTemplate::truncate();
    }

    /**
     * Seed the incident updates table for a given incident.
     *
     * @return void
     */
    protected function seedIncidentUpdates($incident)
    {
        //IncidentUpdate::truncate();

        $defaultUpdates = [
                [
                    'status'  => Incident::FIXED,
                    'message' => 'The monkeys are back and rested!',
                    'user_id' => 1,
                ], [
                    'status'  => Incident::WATCHED,
                    'message' => 'Our monkeys need a break from performing. They\'ll be back after a good rest.',
                    'user_id' => 1,
                ], [
                    'status'  => Incident::IDENTIFIED,
                    'message' => 'We have identified the issue with our lovely performing monkeys.',
                    'user_id' => 1,
                ]
        ];

        
            $random = random_int(0, 2);
            $update = $defaultUpdates[$random];
            $update['incident_id'] = $incident->id;
            IncidentUpdate::create($update);
        
    }

    /**
     * Seed the metric points table.
     *
     * @return void
     */
    protected function seedMetricPoints()
    {
        MetricPoint::truncate();

        // Generate numberOfLoops hours of metric points
        for ($i = 0; $i < $this->numberOfLoops; $i++) {
            $metricTime = (new DateTime())->sub(new DateInterval('PT'.$i.'H'));

            MetricPoint::create([
                'metric_id'  => 1,
                'value'      => random_int(1, 10),
                'created_at' => $metricTime,
                'updated_at' => $metricTime,
            ]);
        }
    }

    /**
     * Seed the metrics table.
     *
     * @return void
     */
    protected function seedMetrics()
    {
        Metric::truncate();

        for ($i = 0; $i < $this->numberOfLoops ; $i++) {
            $defaultMetric = [
                    'name'          => 'Cups of coffee'.$i,
                    'suffix'        => 'Cups'.$i,
                    'description'   => 'How many cups of coffee we\'ve drank.'.$i,
                    'default_value' => 0,
                    'calc_type'     => 1,
                    'display_chart' => 1,
            ];

            Metric::create($defaultMetric);
        }
    }

    /**
     * Seed the schedules table.
     *
     * @return void
     */
    protected function seedSchedules()
    {
        Schedule::truncate();

        for ($i = 0; $i < $this->numberOfLoops ; $i++) {
            $defaultSchedule = [
                    'name'         => 'Demo resets every half hour!'.$i,
                    'message'      => 'You can schedule downtime for _your_ service!'.$i,
                    'status'       => Schedule::UPCOMING,
                    'scheduled_at' => (new DateTime())->add(new DateInterval('PT2H')),
                ];

            Schedule::create($defaultSchedule);
        }
    }

    /**
     * Seed the settings table.
     *
     * @return void
     */
    protected function seedSettings()
    {
        $defaultSettings = [
            [
                'key'   => 'app_name',
                'value' => 'Cachet Demo',
            ], [
                'key'   => 'app_domain',
                'value' => 'https://demo.cachethq.io',
            ], [
                'key'   => 'show_support',
                'value' => '1',
            ], [
                'key'   => 'app_locale',
                'value' => 'en',
            ], [
                'key'   => 'app_timezone',
                'value' => 'Europe/London',
            ], [
                'key'   => 'app_incident_days',
                'value' => '7',
            ], [
                'key'   => 'app_refresh_rate',
                'value' => '0',
            ], [
                'key'   => 'app_analytics',
                'value' => 'UA-58442674-3',
            ], [
                'key'   => 'app_analytics_gs',
                'value' => 'GSN-712462-P',
            ], [
                'key'   => 'display_graphs',
                'value' => '1',
            ], [
                'key'   => 'app_about',
                'value' => 'This is the demo instance of [Cachet](https://cachethq.io?ref=demo). The open source status page system, for everyone. An [Alt Three](https://alt-three.com) product.',
            ], [
                'key'   => 'enable_subscribers',
                'value' => '0',
            ],
        ];

        $this->settings->clear();

        foreach ($defaultSettings as $setting) {
            $this->settings->set($setting['key'], $setting['value']);
        }
    }

    /**
     * Seed the subscribers.
     *
     * @return void
     */
    protected function seedSubscribers()
    {

    }

    /**
     * Seed the users table.
     *
     * @return void
     */
    protected function seedUsers()
    {
        User::truncate();

        for ($i = 0; $i < $this->numberOfLoops ; $i++) {

            $user = [
                'username' => 'test'.$i,
                'password' => 'test123',
                'email'    => 'test@test'.$i.'.com',
                'level'    => User::LEVEL_ADMIN,
                'api_key'  => '9yMHsdioQosnyVK4iCVR'.$i,
            ];

            User::create($user);
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production.'],
        ];
    }
}
