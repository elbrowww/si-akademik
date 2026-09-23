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
│  ├─ Repositories
│  │  └─ MahasiswaRepository.php
│  └─ Views
│     ├─ auth
│     │  └─ login.php
│     ├─ dashboard
│     │  └─ index.php
│     ├─ dosen
│     │  ├─ create.php
│     │  ├─ detail.php
│     │  ├─ edit.php
│     │  └─ index.php
│     └─ mahasiswa
│        ├─ create.php
│        ├─ detail.php
│        ├─ edit.php
│        └─ index.php
├─ config
│  ├─ config.php
│  └─ database.php
├─ public
│  ├─ .htaccess
│  ├─ asset
│  │  └─ css
│  │     └─ style.css
│  └─ index.php
├─ README.md
└─ routes
   └─ web.php