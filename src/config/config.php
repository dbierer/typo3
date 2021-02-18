<?php
$config = [
    'CARDS'  => 'cards',
    'LAYOUT' => 'layout.html',
    'HOST'   => 'https://dentalprovider.net',
    'DELIM'  => '%%',
    'META' => [
        'default' => [
            'title' => 'PHP Training Class | Learn Online | Live Instructor | Web Courses - phpTraining.net',
            'keywords' => 'php, php 8, php8, training, live instructor, online, latest technology, laminas, mezzio, zend framework, drupal, doctrine, cloud service, mongodb, database, web',
            'description'  => 'Clear ideas, clever minds, clean code. PHP Continuous Learning. Let us help you fill in the blanks! PHP, training, learn, programming, education, Web, Websites, courses, classes, developers, skills, professional',
        ],
    ],
    'FILTERS' => [
        'contacts' => [
            'email'   => function($item) { return strip_tags(trim(substr($item, 0, 255)));  },
            'name'    => function($item) { return strip_tags(trim(substr($item, 0, 64)));   },
            'subject' => function($item) { return strip_tags(trim(substr($item, 0, 64)));   },
            'source'  => function($item) { return strip_tags(trim(substr($item, 0, 64)));   },
            'message' => function($item) { return strip_tags(trim(substr($item, 0, 4096))); },
            'created' => function()      { return date('Y-m-d H:i:s');    },
        ],
    ],
    'STORAGE' => [
        'db_host' => 'localhost',
        'db_name' => 'REPL_DB_NAME',
        'db_user' => 'REPL_DB_USER',
        'db_pwd'  => 'REPL_DB_PWD',
    ],
    'COMPANY_EMAIL' => [
        'to'   => 'andrew.caya@etista.com',
        'cc'   => 'doug.bierer@etista.com',
        'from' => 'services@php-cl.com',
        'SUCCESS' => '<span style="color:green;font-weight:700;">Thanks!  Your request has been sent.</span>',
        'ERROR'   => '<span style="color:red;font-weight:700;">Sorry!  Your question, comment or request info was not received.</span>',
        'phpmailer' => [
            'smtp'          => TRUE,                // Use SMTP (true) or PHP Mail() function (false)
            'smtp_host'     => 'REPL_SMTP_HOST',    // SMTP server address - URL or IP
            'smtp_port'     => 587,                 // 25 (standard), 465 (SSL), or 587 (TLS)
            'smtp_auth'     => TRUE,                // SMTP Authentication - PLAIN
            'smtp_username' => 'REPL_SMTP_USERNAME',// Username if smtp_auth is true
            'smtp_password' => 'REPL_SMTP_PASSWORD',// Password if smtp_auth is true
            'smtp_secure'   => 'tls',               // Supported SMTP secure connection - 'none, 'ssl', or 'tls'
        ],
    ],
    'MSG_MARKER'    => '<!-- %%MESSAGES%% -->',
    'CONTACT_LOG'   => BASE_DIR . '/logs/contact.log',
    'CAPTCHA' => [
        'input_tag_name' => 'phrase',
        'sess_hash_key'  => 'hash',
        'font_file'      => SRC_DIR . '/fonts/FreeSansBold.ttf',
        'img_dir'        => BASE_DIR . '/public/img/captcha',
        'num_bytes'      => 2,
    ],
    'QUOTE' => [
        'url' => '/quote',
        'recommendations' => [
            0 => "Sorry!  We don't have sufficient information to put together a recommendation for you.  <br />If you included your email address we'll get back to you. <br />Otherwise, for more information on current courses on offer, <a href='/courses'>click here</a>.",
            1 => '<p>Based on the information you provided us, we recommend these courses:</p><br /> %s  <p>Please bear in mind that all of the courses focus on PHP training. &nbsp;For more information on our courses <a href="/courses">click here</a>.</p>',
        ],
        'fields' => [
            'email'   => 'email',
            'name'    => 'text',
            'additional' => 'textarea',
        ],
        'questions' => [
            'current_occupation' => [
                'type' => 'select',
                'ans' => ['retail','industrial','farming','trade','driver','health','computer','other']
            ],
            // HTML
            'html_experience' => [
                'type' => 'select',
                'ans' => ['none','dabble a bit','studied it at school','fairly proficient','experienced'],
            ],
            // Experience
            'web_sites_developed' => [
                'type' => 'select',
                'ans' => ['none', 'did one for family or friends business', 'just a few','a few dozen','too many to count'],
            ],
            // Goals
            'career_goals' => [
                'type' => 'checkbox',
                'ans' => ['more money','better financial security','health insurance','more satisfaction','start own company','other']
            ],
            // CMS
            'CMS_interest' => [
                'type' => 'checkbox',
                'ans' => ['WordPress','Concrete 5','Drupal','Joomla','Magento','PrestaShop'],
            ],
            // Tech
            'technology_interest' => [
                'type' => 'checkbox',
                'ans' => ['Linux','Windows','Mac','Apache','nginx'],
            ],
            // Language
            'language_interest' => [
                'type' => 'checkbox',
                'ans' => ['PHP','Python','perl','Java','JavaScript','Ruby','C','VisualBasic'],
            ],
            // Frameworks
            'frameworks_interest' => [
                'type' => 'checkbox',
                'ans' => ['Laminas','Mezzio','ZendFramework','Laravel','Symfony','LightMVC','Slim','CodeIgniter','CakePHP'],
            ],
            // Database
            'database_interest' => [
                'type' => 'checkbox',
                'ans' => ['MySQL','MongoDB','MariaDB','Oracle','Microsoft','NoSQL','SQL'],
            ],
        ],
        'decision_matrix' => [
            'gold' => [
                'title' => 'Gold Plan',
                'score' => 0,
                'html_experience' => ['proficient','experienced'],
                'web_sites_developed' => ['dozen','too many'],
            ],
            'platinum' => [
                'title' => 'Platinum Plan',
                'score' => 0,
                'web_sites_developed' => ['one','just'],
                'html_experience' => ['studied','dabble'],
                'CMS_interest' => ['Drupal'],
            ],
            'diamond' => [
                'title' => 'Diamond Plan',
                'score' => 0,
                'frameworks_interest' => ['Laminas','Mezzio','ZendFramework'],
            ],
        ],
    ],
];
return $config;
