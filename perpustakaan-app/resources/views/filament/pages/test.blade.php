<x-filament-panels::page>
    <div class="space-y-6">
        <header class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Halo, Admin Partai XxX</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
        Dashboard ini lengkap dengan peralatan yang membantu partai anda dapat memenangkan lebih banyak kursi!        
        </p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Artisan Commands Section -->
            <section class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <h3 class="flex items-center text-lg font-semibold text-gray-900 dark:text-white">
                    <x-heroicon-o-command-line class="w-5 h-5 mr-2 text-primary-500" />
                    Essential Artisan Commands
                </h3>
                <div class="mt-4 space-y-4">
                    <div class="p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                        <code class="text-sm font-mono text-primary-600 dark:text-primary-400 italic">php artisan make:filament-resource <span class="text-gray-400">{Model}</span> --generate</code>
                        <p class="mt-1 text-xs text-gray-500">Generates a new resource with form and table fields from the database schema.</p>
                    </div>
                    <div class="p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                        <code class="text-sm font-mono text-primary-600 dark:text-primary-400 italic">php artisan make:filament-page <span class="text-gray-400">{Name}</span></code>
                        <p class="mt-1 text-xs text-gray-500">Creates a new custom page in the admin panel.</p>
                    </div>
                    <div class="p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                        <code class="text-sm font-mono text-primary-600 dark:text-primary-400 italic">php artisan migrate:fresh --seed</code>
                        <p class="mt-1 text-xs text-gray-500">Resets the database and populates it with fresh seed data.</p>
                    </div>
                </div>
            </section>

            <!-- Development Tips Section -->
            <section class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <h3 class="flex items-center text-lg font-semibold text-gray-900 dark:text-white">
                    <x-heroicon-o-light-bulb class="w-5 h-5 mr-2 text-amber-500" />
                    Development Tips
                </h3>
                <ul class="mt-4 space-y-3 text-sm text-gray-600 dark:text-gray-400">
                    <li class="flex items-start">
                        <x-heroicon-o-check-circle class="w-4 h-4 mr-2 mt-0.5 text-success-500" />
                        <span>Use <strong>`--generate`</strong> when creating resources to automatically scaffold fields based on your DB columns.</span>
                    </li>
                    <li class="flex items-start">
                        <x-heroicon-o-check-circle class="w-4 h-4 mr-2 mt-0.5 text-success-500" />
                        <span>Customize the <strong>`getNavigationIcon()`</strong> method in your resource to change sidebar icons.</span>
                    </li>
                    <li class="flex items-start">
                        <x-heroicon-o-check-circle class="w-4 h-4 mr-2 mt-0.5 text-success-500" />
                        <span>Leverage <strong>Relation Managers</strong> to manage linked data directly from the parent record view.</span>
                    </li>
                </ul>
            </section>
        </div>

        <footer class="text-center py-4">
            <p class="text-sm text-gray-500">
                Need more help? Check out the <a href="https://filamentphp.com/docs" target="_blank" class="text-primary-600 hover:underline">Official Filament Documentation</a>.
            </p>
        </footer>
    </div>
</x-filament-panels::page>