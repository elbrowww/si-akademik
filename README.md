si-akademik
├─ app
│  ├─ Controllers
│  │  ├─ AuthController.php
│  │  ├─ DosenController.php
│  │  └─ MahasiswaController.php
│  ├─ Middleware
│  │  └─ AuthMiddleware.php
│  ├─ Models
│  │  ├─ Dosen.php
│  │  └─ Mahasiswa.php
│  └─ Views
│     ├─ auth
│     │  └─ login.php
│     ├─ dashboard
│     │  └─ index.php
│     ├─ dosen
│     │  ├─ detail.php
│     │  └─ index.php
│     └─ mahasiswa
│        ├─ detail.php
│        └─ index.php
├─ config
│  └─ config.php
├─ public
│  ├─ .htaccess
│  ├─ asset
│  │  └─ css
│  │     └─ style.css
│  └─ index.php
└─ routes
   └─ web.php