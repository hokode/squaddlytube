<h2>SETUP</h2>
<ol>
  <li>
    composer install
  </li>
  <li>
    npm install && npm run dev
  </li>
  <li>
  	Seed Video categories Table
  	php artisan db:seed
  </li>

  <li>
  	if images are not visible, delete storage folder from public and run
  	php artisan storage:link
  </li>
</ol>