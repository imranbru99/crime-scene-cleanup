<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\KnowledgeArticle;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Product;
use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin', 'manager', 'staff'] as $role) {
            Role::findOrCreate($role);
        }

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '(614) 555-0100',
            ]
        );
        $admin->syncRoles(['admin']);

        User::query()->updateOrCreate(
            ['email' => 'manager@steripathbio.com'],
            [
                'name' => 'Maya Ortiz',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'phone' => '(614) 555-0101',
            ]
        )->syncRoles(['manager']);

        User::query()->updateOrCreate(
            ['email' => 'tech@steripathbio.com'],
            [
                'name' => 'Jordan Blake',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'phone' => '(614) 555-0102',
            ]
        )->syncRoles(['staff']);

        $settings = [
            'company_name' => 'SteriPath Biohazard Cleanup',
            'company_phone' => '(214) 555-0188',
            'company_email' => 'hello@steripathbio.com',
            'whatsapp' => '12145550188',
            'service_area' => 'Columbus, Dublin, Westerville & Dallas–Fort Worth',
            'tax_rate' => '7.50',
        ];
        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }

        $products = [
            ['name' => 'Tyvek Coverall Kit (M/L)', 'sku' => 'BIO-PPE-CVL', 'category' => 'ppe', 'unit_cost' => 18, 'unit_price' => 36, 'stock_qty' => 80],
            ['name' => 'Nitrile Glove Case (100)', 'sku' => 'BIO-PPE-NIT', 'category' => 'ppe', 'unit_cost' => 12, 'unit_price' => 24, 'stock_qty' => 120],
            ['name' => 'Hospital Disinfectant — Gallon', 'sku' => 'BIO-DIS-GAL', 'category' => 'disinfectant', 'unit_cost' => 22, 'unit_price' => 48, 'stock_qty' => 64],
            ['name' => 'Enzymatic Odor Neutralizer', 'sku' => 'BIO-ODR-ENZ', 'category' => 'odor', 'unit_cost' => 28, 'unit_price' => 55, 'stock_qty' => 40],
            ['name' => 'Red Biohazard Bag Bundle', 'sku' => 'BIO-BAG-RED', 'category' => 'waste', 'unit_cost' => 16, 'unit_price' => 32, 'stock_qty' => 90],
            ['name' => 'Sharps Container 5 qt', 'sku' => 'BIO-SHP-5Q', 'category' => 'waste', 'unit_cost' => 9, 'unit_price' => 22, 'stock_qty' => 55],
            ['name' => 'ATP Swab Verification Kit', 'sku' => 'BIO-ATP-10', 'category' => 'verification', 'unit_cost' => 45, 'unit_price' => 85, 'stock_qty' => 24],
            ['name' => 'Electrostatic Sprayer Cartridge', 'sku' => 'BIO-ESP-CAR', 'category' => 'equipment', 'unit_cost' => 38, 'unit_price' => 72, 'stock_qty' => 18],
        ];
        foreach ($products as $product) {
            Product::query()->updateOrCreate(['sku' => $product['sku']], $product + ['unit' => 'kit', 'is_active' => true]);
        }

        $customers = collect([
            ['name' => 'Elena Brooks', 'email' => 'elena@example.com', 'phone' => '(614) 555-3301', 'company' => null, 'city' => 'Columbus', 'state' => 'OH', 'zip' => '43215', 'address' => '412 N High St'],
            ['name' => 'Marcus Hale', 'email' => 'marcus@midohioapts.com', 'phone' => '(614) 555-3310', 'company' => 'Mid-Ohio Apartments', 'city' => 'Columbus', 'state' => 'OH', 'zip' => '43202', 'address' => '1880 N High St'],
            ['name' => 'Priya Shah', 'email' => 'facilities@dublinclinic.org', 'phone' => '(614) 555-3399', 'company' => 'Dublin Family Clinic', 'city' => 'Dublin', 'state' => 'OH', 'zip' => '43017', 'address' => '5500 Frantz Rd'],
            ['name' => 'Noah Reed', 'email' => 'noah.reed@example.com', 'phone' => '(614) 555-3188', 'company' => null, 'city' => 'Westerville', 'state' => 'OH', 'zip' => '43081', 'address' => '92 County Line Rd'],
            ['name' => 'Tina Alvarez', 'email' => 'claims@ohiovalleyins.com', 'phone' => '(740) 555-3177', 'company' => 'Ohio Valley Insurance', 'city' => 'Worthington', 'state' => 'OH', 'zip' => '43085', 'address' => '200 W Wilson Bridge Rd'],
        ])->map(fn ($c) => Customer::query()->updateOrCreate(['email' => $c['email']], $c));

        $projects = [
            ['customer' => 0, 'title' => 'Unattended death — apartment unit 3B', 'service_type' => 'trauma', 'status' => 'scheduled', 'sq_ft' => 620, 'quoted_amount' => 3850],
            ['customer' => 1, 'title' => 'Bloodborne remediation — hallway & stair', 'service_type' => 'bloodborne', 'status' => 'in_progress', 'sq_ft' => 480, 'quoted_amount' => 4200],
            ['customer' => 2, 'title' => 'Clinic infectious disinfection suite', 'service_type' => 'infectious', 'status' => 'quoted', 'sq_ft' => 2100, 'quoted_amount' => 5600],
            ['customer' => 3, 'title' => 'Vehicle trauma interior cleanup', 'service_type' => 'vehicle', 'status' => 'completed', 'sq_ft' => 40, 'quoted_amount' => 1450, 'final_amount' => 1520],
            ['customer' => 4, 'title' => 'Hoarding biohazard progressive clear', 'service_type' => 'hoarding', 'status' => 'invoiced', 'sq_ft' => 1400, 'quoted_amount' => 9800, 'final_amount' => 10250],
        ];

        $projectModels = [];
        foreach ($projects as $i => $p) {
            $customer = $customers[$p['customer']];
            $projectModels[] = Project::query()->updateOrCreate(
                ['job_number' => 'JOB-26'.str_pad((string) ($i + 1), 3, '0', STR_PAD_LEFT)],
                [
                    'customer_id' => $customer->id,
                    'title' => $p['title'],
                    'service_type' => $p['service_type'],
                    'status' => $p['status'],
                    'sq_ft' => $p['sq_ft'],
                    'quoted_amount' => $p['quoted_amount'],
                    'final_amount' => $p['final_amount'] ?? null,
                    'start_date' => now()->subDays(10 - $i)->toDateString(),
                    'site_address' => trim(($customer->address ?? '').', '.$customer->city.', '.$customer->state),
                    'notes' => 'Seeded demo job for SteriPath ERP.',
                ]
            );
        }

        foreach ([0, 1, 3, 4] as $idx) {
            $project = $projectModels[$idx];
            $invoice = Invoice::query()->updateOrCreate(
                ['invoice_number' => 'INV-26'.str_pad((string) ($idx + 1), 3, '0', STR_PAD_LEFT)],
                [
                    'customer_id' => $project->customer_id,
                    'project_id' => $project->id,
                    'issue_date' => now()->subDays(8 - $idx)->toDateString(),
                    'due_date' => now()->addDays(14)->toDateString(),
                    'subtotal' => $project->final_amount ?? $project->quoted_amount,
                    'tax' => round(($project->final_amount ?? $project->quoted_amount) * 0.075, 2),
                    'total' => round(($project->final_amount ?? $project->quoted_amount) * 1.075, 2),
                    'amount_paid' => in_array($project->status, ['completed', 'invoiced'], true) ? round(($project->final_amount ?? $project->quoted_amount) * 1.075, 2) : 0,
                    'status' => in_array($project->status, ['completed', 'invoiced'], true) ? 'paid' : 'sent',
                ]
            );

            if ($invoice->status === 'paid') {
                Payment::query()->updateOrCreate(
                    ['reference' => 'PMT-'.$invoice->invoice_number],
                    [
                        'invoice_id' => $invoice->id,
                        'amount' => $invoice->total,
                        'paid_at' => now()->subDays(3)->toDateString(),
                        'method' => 'card',
                        'notes' => 'Demo payment',
                    ]
                );
            }
        }

        Appointment::query()->updateOrCreate(
            ['title' => 'Trauma assess — Brooks'],
            [
                'customer_id' => $customers[0]->id,
                'project_id' => $projectModels[0]->id,
                'type' => 'measure',
                'starts_at' => now()->addDays(1)->setTime(8, 0),
                'ends_at' => now()->addDays(1)->setTime(9, 0),
                'status' => 'scheduled',
                'location' => $customers[0]->address,
            ]
        );
        Appointment::query()->updateOrCreate(
            ['title' => 'Clinic disinfection day 1'],
            [
                'customer_id' => $customers[2]->id,
                'project_id' => $projectModels[2]->id,
                'type' => 'install',
                'starts_at' => now()->addDays(5)->setTime(6, 30),
                'ends_at' => now()->addDays(5)->setTime(14, 0),
                'status' => 'confirmed',
                'location' => $customers[2]->address,
            ]
        );

        $posts = [
            [
                'title' => 'What Happens During a Trauma Scene Cleanup',
                'excerpt' => 'Containment, removal, disinfection, and documentation — without the mystery.',
                'cover' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=1400&q=80',
                'body' => "Trauma cleanup is not ordinary janitorial work. SteriPath isolates the hot zone, stages PPE, removes contaminated materials, and applies EPA-registered disinfectants with proper dwell times.\n\nFamilies should never attempt DIY cleanup of blood or decomposition. Call professionals so regulated waste is manifested and the space can be released safely.",
            ],
            [
                'title' => 'Does Homeowners Insurance Cover Biohazard Cleanup?',
                'excerpt' => 'Often yes for sudden trauma events — documentation is everything.',
                'cover' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=1400&q=80',
                'body' => "Many homeowners and landlord policies cover trauma and biohazard remediation as a sudden covered loss. SteriPath prepares photo logs, material inventories, and invoices insurers recognize.\n\nAlways call your adjuster early — and do not discard contaminated items before the scope is documented.",
            ],
            [
                'title' => 'Why Odor Remains After a DIY Wipe-Down',
                'excerpt' => 'Masking sprays fail when organic residue sits in porous materials.',
                'cover' => 'https://images.unsplash.com/photo-1563453392212-326f5e854473?auto=format&fit=crop&w=1400&q=80',
                'body' => "If odor returns after cleaning, residual organic material is usually still in carpet pad, subfloor, drywall cavities, or HVAC pathways. SteriPath removes the source first, then uses enzymatic and oxidizing treatments.\n\nPerfume and ozone alone are not a biohazard protocol.",
            ],
        ];
        foreach ($posts as $post) {
            Post::query()->updateOrCreate(
                ['slug' => Str::slug($post['title'])],
                [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'body' => $post['body'],
                    'cover_image' => $post['cover'],
                    'is_published' => true,
                    'published_at' => now()->subDays(random_int(2, 20)),
                ]
            );
        }

        $articles = [
            ['category' => 'issues', 'title' => 'Persistent odor after surface cleaning', 'body' => "1. Identify porous materials still holding organic residue.\n2. Probe carpet pad, baseboards, and HVAC returns.\n3. Remove non-restorable materials into regulated waste bags.\n4. Disinfect structural surfaces and apply enzymatic odor control."],
            ['category' => 'issues', 'title' => 'Blood staining on unfinished wood', 'body' => "Unfinished wood can wick fluids deep into grain. Sanding alone is not remediation. SteriPath isolates, treats with appropriate chemistry, and may remove boards that fail verification."],
            ['category' => 'guides', 'title' => 'Trauma job timeline', 'body' => "Hour 0: Dispatch intake and discreet arrival.\nHour 1: Containment and PPE staging.\nHours 2–8: Removal, disinfection, waste packaging.\nCloseout: Photos, ATP if required, invoice packet for insurer."],
            ['category' => 'guides', 'title' => 'How property managers should prepare', 'body' => "Secure the unit, keep tenants out, notify insurer if applicable, and avoid DIY cleaning. Provide access keys and emergency contacts. SteriPath handles PPE, chemistry, and waste manifests."],
            ['category' => 'admin', 'title' => 'Admin ERP quick start', 'body' => "Login at /admin with admin@example.com / password.\n1. Add customers in CRM.\n2. Create a Job/Project with sq ft and quote.\n3. Schedule appointments for assess/remediate.\n4. Convert completed jobs to invoices and record payments.\n5. Use AI Studio for blog drafts and troubleshooting suggestions.\n6. Update company Settings for phone, WhatsApp, and tax rate."],
            ['category' => 'admin', 'title' => 'Roles: Admin, Manager, Staff', 'body' => "Admin: full ERP + settings + users.\nManager: jobs, inventory, invoices, scheduling.\nStaff: field-facing records and appointment updates.\nAssign roles on the Users resource."],
            ['category' => 'troubleshoot', 'title' => 'Job running over PPE kit estimate', 'body' => "Check actual room count vs quote. Confirm extra coveralls for multi-tech shifts. Log additional kits on the job notes, create a change-order invoice line, and update inventory stock quantities."],
            ['category' => 'troubleshoot', 'title' => 'Chatbot giving demo answers only', 'body' => "Demo mode is expected without API keys. Add OPENAI_API_KEY or GEMINI_API_KEY to .env, then clear config cache. The public chatbot and AI Studio will prefer live models when keys are present."],
        ];
        foreach ($articles as $article) {
            KnowledgeArticle::query()->updateOrCreate(
                ['slug' => Str::slug($article['title'])],
                [
                    'title' => $article['title'],
                    'category' => $article['category'],
                    'body' => $article['body'],
                    'is_published' => true,
                ]
            );
        }
    }
}
