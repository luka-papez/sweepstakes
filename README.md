# 📻 Sweepstakes

A small Laravel app for radio and TV station contests. Stations run contests,
listeners enter through a JSON API, every entry is passed on to the contest
sponsor's CRM, and when a contest ends someone wins a prize.

You'll use it in your technical interview. It's small on purpose: you should be
able to read the whole thing in about 5 minutes.

## Running it

**Please run the app on your own computer**, using Docker or PHP. That's the setup you'll work in
day to day, and we'd like to see you in it. Use GitHub Codespaces only if neither works for you.

Every option gives you the app with a SQLite database full of sample data, so you don't need
MySQL, Redis or Node.

### Option A: Docker

You need Docker with Compose v2.

```bash
docker compose up
```

The first start takes a minute or two while it installs dependencies.
Once you see `Server running on [http://0.0.0.0:8000]`, open **http://localhost:8000**.

Run any other command inside the container:

```bash
docker compose exec app php artisan test
docker compose exec app php artisan queue:work
docker compose exec app php artisan tinker
```

### Option B: PHP on your machine

You need PHP 8.3 or newer with the `pdo_sqlite` extension (`php -m | grep sqlite`),
plus [Composer](https://getcomposer.org/).

```bash
composer setup   # install dependencies, create .env, create and seed the database
composer dev     # start the server on http://localhost:8000
```

### Fallback: GitHub Codespaces

Only if you can't use Docker or PHP locally. On your repository's page, click
**Code → Codespaces → Create codespace on main**. You get VS Code in your browser with PHP already
installed. The first start takes a couple of minutes while it installs dependencies and seeds the
database; then the app starts by itself and opens in a preview tab.

Run commands like `php artisan test` in the VS Code terminal. If you stop the server, start it
again with `composer dev`. Codespaces are free for personal GitHub accounts up to a monthly quota,
which this interview won't come close to using.

## Useful commands

| Command | What it does |
|---|---|
| `php artisan test` | Run the test suite (all green out of the box) |
| `composer reset` | Wipe the database and re-seed the sample data |
| `php artisan queue:work` | Process queued jobs |
| `php artisan route:list --except-vendor` | List every route |

Set `DB_LOG_QUERIES=true` in `.env` to write every SQL query to `storage/logs/laravel.log`.

## Trying the API

```bash
curl http://localhost:8000/api/contests
curl http://localhost:8000/api/contests/1

curl -X POST http://localhost:8000/api/contests/1/entries \
     -H 'Accept: application/json' -H 'Content-Type: application/json' \
     -d '{"name": "Jane Listener", "email": "jane@example.com"}'
```

## Where things are

```
app/Models/                       Station, Contest, Entry
app/Http/Controllers/Api/         ContestController, EntryController
app/Http/Requests/                StoreEntryRequest (validation for new entries)
app/Http/Resources/               JSON shape of the API responses
app/Services/SponsorCrm.php       The (simulated, slow) third-party sponsor CRM
database/migrations/              Schema
database/seeders/                 Sample data
routes/api.php                    API routes
tests/                            Feature and unit tests
```

Your first interview task is in [TASKS.md](TASKS.md).
