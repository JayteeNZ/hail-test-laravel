## Install and run this application

1. Clone the repository, or download the application as a ZIP.
2. Setup the .env file, generate a key etc
3. Run ``composer install`` to install the vendor dependencies for PHP and Laravel.
4. Run ``yarn or npm`` to install the dependencies, and then ``npm run dev|production`` to bundle them (alternatively, use the already bundled files in the public folder)
5. Setup a database and migrate the migrations

## Assessment Notes

This is just a quick assessment. If I were to continue this application like it was a real production app,
I would likely setup other models and database tables, alongside caching, to fetch the data from Hail, and then store it locally.

I would also ensure exceptions/validation is setup accordingly, and use Vue/Axios for the front-end as an SPA.

This application demo just gets the point across that it can connect to the API and fetch the demo organisation (based on the latest organisation created) and it's images. It is not exactly efficient.