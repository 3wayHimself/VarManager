# VarManager
Inspired to Variable Managment in JSON. Supporting More Of 70K Variables in seconds.

# Features

- [x] Supporting more of 70k variables.
- [x] Instant processing (ms).
- [x] Data protected and encrypted (optional).
- [x] Lightweight.

# Sample Usage
```php
require('varmanager.php');
$VarManager = new VarManager('varmanager.data.php'); //  Optional, (Always .php to protect data)

// Optional, (Recommended)
$VarManager->encryptAll();

$VarManager->set('Testing Variable', 'This Testing its nice?: ');
$VarManager->set('Nice', "Yes");

echo $VarManager->get('Testing Variable') . $VarManager->get('Nice');
```

# Requirements

- [x] PHP5.x+
- [x] Permissions 777 To Varmanager.php (Write, Read)
