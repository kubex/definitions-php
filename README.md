# App Definitions

PHP definitions for Kubex applications, matching the published Go SDK models.
Requires PHP 8.0 or later. Composer loads the classes and the namespaced endpoint
constants in `Paths.php`.

Definitions support provider registrations and dependencies, system/user access
restrictions, JavaScript requirements (`Necessity`), and blueprint/help discovery.
Return `BlueprintsResponse` from `/_kubex/blueprints` and `HelpArticlesResponse`
from `/_kubex/help`, with `provideBlueprints` / `provideHelp` enabled on the app.
Help articles are served separately from the app definition.

```php
use Kubex\Definitions\Definition;
use Kubex\Definitions\EntryPoint;
use Kubex\Definitions\LaunchMode;
use Kubex\Definitions\Necessity;

$definition = new Definition();
// Set the app ID, name and other application fields as usual.
$definition->javascriptExecution = Necessity::Required;
$definition->searchPanel = EntryPoint::create('/search', 'Search');
$definition->searchPanel->launchMode = LaunchMode::Modal;
$definition->provideHelp = true;
```

`searchPanelPath` is deprecated. Existing callers can continue assigning it;
serialization also generates a `searchPanel` entry point from that path. An
explicit `searchPanel` takes precedence. The legacy field remains in JSON for
older consumers.

`IntegrationPoint::$secondaryActions` contains entry points shown on long press
or right click. `Path::$kiosk` enables kiosk mode for a path. Distributors are
available through `BuiltInResource::Distributor` and `Headers::RequestDistributors`.

`PermissionMeta::$min` and `$max` default to `null` (omitted). Setting either to
`0` sends an explicit zero bound. Code checking whether a bound is set should
compare against `null`.

Request and response helpers are independent of an HTTP framework:

```php
use Kubex\Definitions\Headers;
use Kubex\Definitions\RequestContext;
use Kubex\Definitions\ResponseWriter;
use Kubex\Definitions\ScopedKey;

$context = new RequestContext(getallheaders(), $definition->id);
$signatureKey = Headers::createSignatureKey($workspaceID, $appSecret);
if(!$context->verify($signatureKey)
  || !$context->hasResourcePermission(ScopedKey::createKey('view'), 'invoice/123'))
{
  http_response_code(403);
  return;
}

ResponseWriter::create()->refreshDataTable('#invoices')->noContent()->write();
```

`RequestContext` reads credentials, permissions and built-in resources; deny
rules take precedence. `ResponseWriter::getHeaders()` and `getStatusCode()` allow
framework adapters to apply the result themselves. `Alert` and `AlertButton`
provide structured alert headers. Semantic versions use
`Kubex\Definitions\Semver\Version::parse()`, separate from the application build
metadata in `Kubex\Definitions\Version`. Installation request/response, vendor
and event models are also available.

Run the serialization and protocol checks with `composer test` or
`php tests/parity.php`. The latter accepts `--json` to emit the populated fixtures
for interoperability checks against the Go SDK.
