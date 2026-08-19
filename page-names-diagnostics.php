<?php
declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| GMG PAGE NAMES DIAGNOSTIC
|--------------------------------------------------------------------------
| Put this file in the PROJECT ROOT:
|
|   C:\wamp64\www\gmigroup\page-names-diagnostic.php
|
| Then open:
|
|   http://localhost/gmigroup/page-names-diagnostic.php
|
| Delete this file after testing.
|--------------------------------------------------------------------------
*/

header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

$root = __DIR__;

function h(mixed $value): string
{
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}

function resultRow(
    string $name,
    bool $ok,
    string $details = ''
): void {
    $status = $ok ? 'PASS' : 'FAIL';
    $class = $ok ? 'pass' : 'fail';

    echo '<tr>';
    echo '<td>' . h($name) . '</td>';
    echo '<td class="' . $class . '"><strong>' . h($status) . '</strong></td>';
    echo '<td><code>' . h($details) . '</code></td>';
    echo '</tr>';
}

$results = [];

function addResult(
    string $name,
    bool $ok,
    string $details = ''
): void {
    global $results;

    $results[] = [
        'name' => $name,
        'ok' => $ok,
        'details' => $details,
    ];
}

/* ---------------------------------------------------------
   1. Basic project paths
   --------------------------------------------------------- */

$bootstrapFile = $root . DIRECTORY_SEPARATOR . 'bootstrap.php';
$modelFile = $root . DIRECTORY_SEPARATOR
    . 'app' . DIRECTORY_SEPARATOR
    . 'Models' . DIRECTORY_SEPARATOR
    . 'PageBreadcrumb.php';

$controllerFile = $root . DIRECTORY_SEPARATOR
    . 'app' . DIRECTORY_SEPARATOR
    . 'Controllers' . DIRECTORY_SEPARATOR
    . 'Admin' . DIRECTORY_SEPARATOR
    . 'PageBreadcrumbController.php';

$viewFile = $root . DIRECTORY_SEPARATOR
    . 'app' . DIRECTORY_SEPARATOR
    . 'Views' . DIRECTORY_SEPARATOR
    . 'admin' . DIRECTORY_SEPARATOR
    . 'page-names' . DIRECTORY_SEPARATOR
    . 'index.php';

$layoutFile = $root . DIRECTORY_SEPARATOR
    . 'app' . DIRECTORY_SEPARATOR
    . 'Views' . DIRECTORY_SEPARATOR
    . 'admin' . DIRECTORY_SEPARATOR
    . 'layouts' . DIRECTORY_SEPARATOR
    . 'app.php';

$adminIndexFile = $root . DIRECTORY_SEPARATOR
    . 'admin' . DIRECTORY_SEPARATOR
    . 'index.php';

addResult(
    'Project root',
    is_dir($root),
    $root
);

addResult(
    'bootstrap.php exists',
    is_file($bootstrapFile),
    $bootstrapFile
);

addResult(
    'PageBreadcrumb model file exists',
    is_file($modelFile),
    $modelFile
);

addResult(
    'PageBreadcrumbController file exists',
    is_file($controllerFile),
    $controllerFile
);

addResult(
    'Page Names view exists',
    is_file($viewFile),
    $viewFile
);

addResult(
    'Admin layout exists',
    is_file($layoutFile),
    $layoutFile
);

addResult(
    'Admin index exists',
    is_file($adminIndexFile),
    $adminIndexFile
);

/* ---------------------------------------------------------
   2. Load application bootstrap
   --------------------------------------------------------- */

$bootstrapLoaded = false;

if (is_file($bootstrapFile)) {
    try {
        require_once $bootstrapFile;
        $bootstrapLoaded = true;

        addResult(
            'Bootstrap loads successfully',
            true,
            'bootstrap.php loaded'
        );
    } catch (Throwable $exception) {
        addResult(
            'Bootstrap loads successfully',
            false,
            get_class($exception) . ': '
                . $exception->getMessage()
                . ' @ '
                . $exception->getFile()
                . ':'
                . $exception->getLine()
        );
    }
}

/* ---------------------------------------------------------
   3. Check application classes/autoloading
   --------------------------------------------------------- */

if ($bootstrapLoaded) {
    $classes = [
        'Database class' =>
            'Gmg\\Events\\Core\\Database',

        'PageBreadcrumb model class' =>
            'Gmg\\Events\\Models\\PageBreadcrumb',

        'PageBreadcrumbController class' =>
            'Gmg\\Events\\Controllers\\Admin\\PageBreadcrumbController',

        'Base Controller class' =>
            'Gmg\\Events\\Core\\Controller',

        'Auth class' =>
            'Gmg\\Events\\Core\\Auth',
    ];

    foreach ($classes as $label => $className) {
        try {
            $exists = class_exists($className);

            addResult(
                $label . ' autoloads',
                $exists,
                $exists
                    ? $className
                    : 'Class not found: ' . $className
            );
        } catch (Throwable $exception) {
            addResult(
                $label . ' autoloads',
                false,
                get_class($exception) . ': '
                    . $exception->getMessage()
                    . ' @ '
                    . $exception->getFile()
                    . ':'
                    . $exception->getLine()
            );
        }
    }
}

/* ---------------------------------------------------------
   4. Database + page_breadcrumb_settings table
   --------------------------------------------------------- */

$db = null;

if (
    $bootstrapLoaded
    && class_exists('Gmg\\Events\\Core\\Database')
) {
    try {
        $db = \Gmg\Events\Core\Database::connection();

        addResult(
            'Database connection',
            $db instanceof PDO,
            $db instanceof PDO
                ? 'PDO connection established'
                : 'Database::connection() did not return PDO'
        );
    } catch (Throwable $exception) {
        addResult(
            'Database connection',
            false,
            get_class($exception) . ': '
                . $exception->getMessage()
                . ' @ '
                . $exception->getFile()
                . ':'
                . $exception->getLine()
        );
    }
}

if ($db instanceof PDO) {
    try {
        $statement = $db->query(
            "SHOW TABLES LIKE 'page_breadcrumb_settings'"
        );

        $exists = (bool) $statement->fetchColumn();

        addResult(
            'page_breadcrumb_settings table exists',
            $exists,
            $exists
                ? 'Table found'
                : 'TABLE MISSING — import page_names_update.sql'
        );
    } catch (Throwable $exception) {
        addResult(
            'page_breadcrumb_settings table exists',
            false,
            get_class($exception) . ': '
                . $exception->getMessage()
                . ' @ '
                . $exception->getFile()
                . ':'
                . $exception->getLine()
        );

        $exists = false;
    }

    if (!empty($exists)) {
        try {
            $columnsStatement = $db->query(
                'SHOW COLUMNS FROM page_breadcrumb_settings'
            );

            $columns = [];

            foreach ($columnsStatement->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $columns[] = (string) ($row['Field'] ?? '');
            }

            $requiredColumns = [
                'page_key',
                'page_name',
                'updated_by',
                'created_at',
                'updated_at',
            ];

            $missingColumns = array_values(
                array_diff($requiredColumns, $columns)
            );

            addResult(
                'Required table columns',
                $missingColumns === [],
                $missingColumns === []
                    ? implode(', ', $requiredColumns)
                    : 'Missing: ' . implode(', ', $missingColumns)
            );
        } catch (Throwable $exception) {
            addResult(
                'Required table columns',
                false,
                get_class($exception) . ': '
                    . $exception->getMessage()
                    . ' @ '
                    . $exception->getFile()
                    . ':'
                    . $exception->getLine()
            );
        }

        try {
            $query = $db->query(
                'SELECT page_key, page_name, updated_by,
                        created_at, updated_at
                 FROM page_breadcrumb_settings
                 ORDER BY page_key ASC'
            );

            $rows = $query->fetchAll(PDO::FETCH_ASSOC);

            addResult(
                'Page Names SELECT query',
                true,
                'Query works. Rows found: ' . count($rows)
            );
        } catch (Throwable $exception) {
            addResult(
                'Page Names SELECT query',
                false,
                get_class($exception) . ': '
                    . $exception->getMessage()
                    . ' @ '
                    . $exception->getFile()
                    . ':'
                    . $exception->getLine()
            );
        }
    }
}

/* ---------------------------------------------------------
   5. Test PageBreadcrumb model directly
   --------------------------------------------------------- */

if (
    $db instanceof PDO
    && class_exists('Gmg\\Events\\Models\\PageBreadcrumb')
) {
    try {
        $model = new \Gmg\Events\Models\PageBreadcrumb($db);

        $about = $model->get('about-us', 'About Us');

        addResult(
            'PageBreadcrumb::get()',
            is_array($about),
            is_array($about)
                ? 'Returned: '
                    . (string) ($about['page_name'] ?? '[no page_name]')
                : 'Model did not return an array'
        );
    } catch (Throwable $exception) {
        addResult(
            'PageBreadcrumb::get()',
            false,
            get_class($exception) . ': '
                . $exception->getMessage()
                . ' @ '
                . $exception->getFile()
                . ':'
                . $exception->getLine()
        );
    }
}

/* ---------------------------------------------------------
   6. Check router contents
   --------------------------------------------------------- */

if (is_file($adminIndexFile)) {
    $adminIndexSource = (string) file_get_contents($adminIndexFile);

    addResult(
        'GET page-names route registered',
        str_contains(
            $adminIndexSource,
            "'page-names'"
        ),
        str_contains($adminIndexSource, "'page-names'")
            ? 'page-names route text found'
            : 'page-names route text NOT found'
    );

    addResult(
        'PageBreadcrumbController imported in admin/index.php',
        str_contains(
            $adminIndexSource,
            'PageBreadcrumbController'
        ),
        str_contains($adminIndexSource, 'PageBreadcrumbController')
            ? 'Controller reference found'
            : 'Controller reference NOT found'
    );

    addResult(
        'Schema preflight includes page_breadcrumb_settings',
        str_contains(
            $adminIndexSource,
            'page_breadcrumb_settings'
        ),
        str_contains($adminIndexSource, 'page_breadcrumb_settings')
            ? 'Schema rule found'
            : 'Schema rule NOT found'
    );
}

/* ---------------------------------------------------------
   7. Optional base URL
   --------------------------------------------------------- */

if ($bootstrapLoaded && function_exists('base_url')) {
    try {
        addResult(
            'Configured base URL',
            true,
            base_url('')
        );
    } catch (Throwable $exception) {
        addResult(
            'Configured base URL',
            false,
            $exception->getMessage()
        );
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width,initial-scale=1"
    >
    <title>GMG Page Names Diagnostic</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 32px 18px;
            background: #f4f7fb;
            color: #102033;
            font-family: Arial, sans-serif;
        }

        .wrap {
            width: min(1100px, 100%);
            margin: 0 auto;
        }

        .card {
            overflow: hidden;
            border: 1px solid #dfe7ef;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 12px 34px rgba(7, 21, 37, .08);
        }

        .head {
            padding: 24px;
            color: #fff;
            background: #20366c;
        }

        .head h1 {
            margin: 0 0 8px;
            font-size: 25px;
        }

        .head p {
            margin: 0;
            color: #dbe7ff;
            line-height: 1.6;
        }

        .body {
            padding: 22px;
        }

        .notice {
            margin-bottom: 18px;
            padding: 14px 16px;
            border: 1px solid #f3cf89;
            border-radius: 10px;
            color: #7a4d00;
            background: #fff8e8;
            line-height: 1.55;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 13px 12px;
            border-bottom: 1px solid #edf1f5;
            text-align: left;
            vertical-align: top;
        }

        th {
            color: #526070;
            background: #f8fafc;
            font-size: 12px;
        }

        td {
            font-size: 13px;
        }

        code {
            white-space: pre-wrap;
            word-break: break-word;
        }

        .pass {
            color: #067647;
        }

        .fail {
            color: #b42318;
        }

        .footer-note {
            margin-top: 20px;
            color: #657488;
            font-size: 13px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
<div class="wrap">
    <div class="card">
        <div class="head">
            <h1>GMG Page Names Diagnostic</h1>
            <p>
                This page checks the exact dependencies used by
                <strong>?action=page-names</strong>.
            </p>
        </div>

        <div class="body">
            <div class="notice">
                After testing, delete
                <strong>page-names-diagnostic.php</strong>
                from your project root.
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>Check</th>
                        <th>Status</th>
                        <th>Details</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($results as $result): ?>
                        <?php
                        resultRow(
                            $result['name'],
                            $result['ok'],
                            $result['details']
                        );
                        ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="footer-note">
                Send the rows marked <strong class="fail">FAIL</strong>
                back to ChatGPT. They will identify the exact cause
                of the HTTP 500.
            </div>
        </div>
    </div>
</div>
</body>
</html>