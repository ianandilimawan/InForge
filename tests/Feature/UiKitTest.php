<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UiKitTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $role = Role::create(['name' => 'super-admin']);
        $this->admin = User::factory()->create();
        $this->admin->assignRole($role);
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('admin.uikit'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_view_uikit_showcase(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.uikit'));

        $response->assertStatus(200);
        $response->assertSee('UI Components Showcase');
        $response->assertSee('Buttons');
        $response->assertSee('Badges');
        $response->assertSee('Project Budget (IDR)');
        $response->assertSee('data-currency', false);
        $response->assertSee('Password strength:');
        $response->assertSee('Annual Budget (IDR)');
        $response->assertSee('tinymce', false);
        $response->assertSee('Native Multi-Select');
        $response->assertSee('Grouped Options');
        $response->assertSee('Modern Checkbox Components');
        $response->assertSee('Radio Selection Components');
        $response->assertSee('Accent Color Variants Showcase');
        $response->assertSee('Form Groups & Input Addons', false);
        $response->assertSee('Input Addons');
        $response->assertSee('Horizontal Form Layout (Settings Style)');
        $response->assertSee('iOS-Style Toggle Switches');
        $response->assertSee('Interactive Modals & Dialogs', false);
        $response->assertSee('KPI & Stat Metric Cards', false);
        $response->assertSee('Total Revenue');
        $response->assertSee('Tabs & Segmented Controls', false);
        $response->assertSee('Segmented Pills Navigation');
        $response->assertSee('Data Tables & Dropdown Action Menus', false);
        $response->assertSee('Sarah Jenkins');
        $response->assertSee('Empty State Component');
        $response->assertSee('Avatars, Stacks & Skeleton Loaders', false);
        $response->assertSee('Animated Skeleton Loaders');
        $response->assertSee('Breadcrumbs & Steppers', false);
        $response->assertSee('Multi-Step Onboarding Stepper');
        $response->assertSee('Timeline & Activity Feeds', false);
        $response->assertSee('Accordions & Slide-Over Drawer', false);
        $response->assertSee('Progress Bars & Description Lists', false);
        $response->assertSee('Linear Progress Indicators');
        $response->assertSee('Key-Value Description List');
        $response->assertSee('Floating Single-Line Inputs & Controls');
        $response->assertSee('Floating Password Evaluation & Multiline Textarea');
        $response->assertSee('Micro-Components & Developer Helpers', false);
        $response->assertSee('Tooltips & Copy-to-Clipboard Buttons');
        $response->assertSee('Terminal & Code Blocks');
        $response->assertSee('Dividers & Visual Separators');
        $response->assertSee('Interactive Star Rating System');
        $response->assertSee('Top Tooltip');
        $response->assertSee('Copy Endpoint');
        $response->assertSee('Terminal Quickstart');
        $response->assertSee('Input Hints, Tooltips, Required & Validation States');
        $response->assertSee('NPWP / Tax ID');
        $response->assertSee('Recovery Email');
        $response->assertSee('SEO Meta Title');
        $response->assertSee('Quick Filter Tag');
        $response->assertSee('Workspace Subdomain');
        $response->assertSee('Voucher Promo Code');
        $response->assertSee('Modern Inputs with Built-in Icons');
        $response->assertSee('Campaign Budget (IDR)');
        $response->assertSee('Official Work Email');
        $response->assertSee('Global Filter Tag');
        $response->assertSee('WhatsApp Hotline');
        $response->assertSee('Encrypted Gateway Host');
    }

    public function test_input_advanced_features_render_correctly(): void
    {
        $view = $this->blade('<x-input name="test_field" label="Test Field" :required="true" hint="This is a helper hint" tooltip="Helpful explanation" corner="Optional" :clearable="true" state="success" />');
        $view->assertSee('Test Field');
        $view->assertSee('*'); // Required asterisk
        $view->assertSee('This is a helper hint');
        $view->assertSee('Helpful explanation'); // Tooltip text
        $view->assertSee('Optional'); // Corner text
        $view->assertSee('Clear text'); // Clearable button aria

        $view = $this->blade('<x-input name="err_field" label="Error Field" state="error" errorMessage="Field is invalid" />');
        $view->assertSee('Field is invalid');

        $view = $this->blade('<x-modern-input name="mod_input" label="Modern Input" icon="currency" :isCurrency="true" :required="true" tooltip="Currency tooltip" hint="Currency hint" />');
        $view->assertSee('Modern Input');
        $view->assertSee('*');
        $view->assertSee('Currency tooltip');
        $view->assertSee('Currency hint');
        $view->assertSee('data-currency="true"', false);

        $view = $this->blade('<x-input-floating name="fl_input" label="Float Currency" :isCurrency="true" :required="true" hint="Float hint" />');
        $view->assertSee('Float Currency');
        $view->assertSee('*');
        $view->assertSee('Float hint');
        $view->assertSee('data-currency', false);

        $view = $this->blade('<x-input name="right_aligned" align="right" />');
        $view->assertSee('text-right');

        $view = $this->blade('<x-textarea name="desc" label="Description" :required="true" tooltip="Details" :counter="true" :maxlength="200" hint="Write details" />');
        $view->assertSee('Description');
        $view->assertSee('*');
        $view->assertSee('Details');
        $view->assertSee('Write details');
        $view->assertSee('200');
    }

    public function test_micro_components_render_correctly(): void
    {
        $view = $this->blade('<x-copy-button text="sample-text" label="Copy Link" />');
        $view->assertSee('sample-text');
        $view->assertSee('Copy Link');

        $view = $this->blade('<x-copy-button text="sample-secret" variant="solid" label="Copy Secret" />');
        $view->assertSee('Copy Secret');
        $view->assertSee('dark:text-white');

        $view = $this->blade('<x-tooltip text="Help info" position="bottom"><button>Hover me</button></x-tooltip>');
        $view->assertSee('Help info');
        $view->assertSee('Hover me');

        $view = $this->blade('<x-code-block language="PHP" title="Artisan Command">php artisan test</x-code-block>');
        $view->assertSee('Artisan Command');
        $view->assertSee('PHP');
        $view->assertSee('php artisan test');

        $view = $this->blade('<x-divider label="OR CONTINUE" badge="NEW" :dashed="true" />');
        $view->assertSee('OR CONTINUE');
        $view->assertSee('NEW');

        $view = $this->blade('<x-rating name="score" :value="4" :showValue="true" color="rose" />');
        $view->assertSee('score');
        $view->assertSeeText('4 / 5');
    }
}
