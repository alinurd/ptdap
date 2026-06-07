<?php

namespace App\Data;

class AdminMenus
{
    /**
     * Mengembalikan struktur menu admin.
     * Digunakan oleh sidebar (menu.blade.php) dan dashboard (dashboard.blade.php).
     *
     * Setiap section berisi:
     *   - header : label section di sidebar
     *   - groups : daftar grup menu
     *
     * Setiap group berisi:
     *   - title        : nama grup
     *   - sidebar_icon : icon tabler untuk sidebar parent
     *   - direct       : true jika langsung link (bukan dropdown)
     *   - route        : (hanya jika direct=true) route direct
     *   - items        : sub-item [ route, label, icon (gambar dashboard) ]
     */
    public static function sections(): array
    {
        return [
            [
                'header' => 'Konten Website',
                'groups' => [
                    [
                        'title'        => 'Banner',
                        'sidebar_icon' => 'ti ti-photo',
                        'items' => [
                            ['route' => 'admin.master.banner.index',         'label' => 'Beranda', 'icon' => 'icon-be-19.png'],
                            ['route' => 'admin.master.banner-halaman.index', 'label' => 'Halaman', 'icon' => 'icon-be-28.png'],
                        ],
                    ],
                    [
                        'title'        => 'Master Data',
                        'sidebar_icon' => 'ti ti-database',
                        'items' => [
                            ['route' => 'admin.master.bisnis-kategori.index', 'label' => 'Bisnis Kategori',   'icon' => 'icon-be-21.png'],
                            ['route' => 'admin.master.company.index',         'label' => 'Mengenai Kami',      'icon' => 'icon-be-26.png'],
                            ['route' => 'admin.master.customer.index',        'label' => 'Mitra Strategis',    'icon' => 'icon-be-10.png'],
                            ['route' => 'admin.master.pengalaman.index',      'label' => 'Pengalaman Kami',    'icon' => 'icon-be-23.png'],
                            ['route' => 'admin.master.personil.index',        'label' => 'Personil Manajemen', 'icon' => 'icon-be-22.png'],
                         ],
                    ],
                    [
                        'title'        => 'Dokumen',
                        'sidebar_icon' => 'ti ti-files',
                        'items' => [
                            ['route' => 'admin.master.dokumen-kategori.index', 'label' => 'Kategori', 'icon' => 'icon-be-16.png'],
                            ['route' => 'admin.master.dokumen.index',          'label' => 'Dokumen',  'icon' => 'icon-be-27.png'],
                        ],
                    ],
                    [
                        'title'        => 'Berita',
                        'sidebar_icon' => 'ti ti-news',
                        'items' => [
                            ['route' => 'admin.master.berita-kategori.index', 'label' => 'Kategori', 'icon' => 'icon-be-11.png'],
                            ['route' => 'admin.master.berita.index',          'label' => 'Berita',   'icon' => 'icon-be-15.png'],
                        ],
                    ],
                ],
            ],

            [
                'header' => 'User Management',
                'groups' => [
                    [
                        'title'        => 'Users',
                        'sidebar_icon' => 'ti ti-users',
                        'direct'       => true,
                        'route'        => 'admin.userman.user.view',
                        'items' => [
                            ['route' => 'admin.userman.user.view', 'label' => 'Users', 'icon' => 'icon-be-02.png'],
                        ],
                    ],
                    [
                        'title'        => 'Roles & Permissions',
                        'sidebar_icon' => 'ti ti-settings',
                        'items' => [
                            ['route' => 'admin.userman.role.view',       'label' => 'Roles',       'icon' => 'icon-be-06.png'],
                            ['route' => 'admin.userman.permission.view', 'label' => 'Permissions', 'icon' => 'icon-be-09.png'],
                        ],
                    ],
                ],
            ],

            [
                'header' => 'Settings',
                'groups' => [
                    [
                        'title'        => 'App Settings',
                        'sidebar_icon' => 'ti ti-table-options',
                        'direct'       => true,
                        'route'        => 'admin.setting.appsetting.index',
                        'items' => [
                            ['route' => 'admin.setting.appsetting.index', 'label' => 'App Setting', 'icon' => 'icon-be-05.png'],
                        ],
                    ],
                ],
            ],
        ];
    }
}
