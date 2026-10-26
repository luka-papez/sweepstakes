# 📻 Sweepstakes

Thanks for interviewing with us. This is the sample Laravel app you'll work in during your
interviews. This page explains what we expect from you and how to get the app running.

## What we expect from you

### Before your first interview

1. **Make your own copy of this repository.** Click **Use this template → Create a new repository**
   at the top of this page. Private is fine.
2. **Get the app running on your own computer**, using Docker or PHP (see [Running the app](#running-the-app)).
   It's the setup you'd work in every day, and we'd like to see you in it. GitHub Codespaces is
   there as a fallback if neither works for you.
3. **Read [Task 0](TASKS.md)**, the task for your first interview, but **don't start it**:
   we'll do it together during the call.
4. **When the call starts**, have the app's homepage (the list of contests) open in your browser,
   and be ready to share your screen.

A senior engineer should be up and running in 15 minutes or less. If you get stuck, see
[Getting stuck](#getting-stuck).

### During the interviews

- **Share your screen and think aloud.** We care about how you work, not only whether you finish.
- **Use your normal editor and any documentation you like** (laravel.com/docs, `php artisan help`, Stack Overflow).
- **AI assistants are allowed** (Copilot, ChatGPT, Claude, Cursor and similar). If you use them, we'll
  expect more: a finished, tested result, and that you can explain every line of it.
- **Ask if something is unclear.** Asking a good question is part of the job.
- **Follow the instructions closely.** A small change that does exactly what was asked beats a big one that doesn't.

### After the first interview

Keep your copy of the repository. If you move on to the next interview, you'll work in the same copy,
and we may ask you to add us as a collaborator so we can look at your changes.

## Running the app

Every option gives you the app with a SQLite database full of sample data, so you don't need
MySQL, Redis or Node. Try them in order.

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

Only if you can't use Docker or PHP locally. On your copy's GitHub page, click
**Code → Codespaces → Create codespace on main**. You get VS Code in your browser with PHP already
installed. The first start takes a couple of minutes while it installs dependencies and seeds the
database. If VS Code asks whether you trust the authors of the files, choose **Trust**.

The app starts by itself. To open it, go to the **Ports** tab at the bottom of VS Code and click
the globe icon next to port 8000. If you ever need to restart it, run `composer dev` in the terminal.

Run commands like `php artisan test` in the VS Code terminal. Codespaces are free for personal
GitHub accounts up to a monthly quota, which this interview won't come close to using.

### Check that it works

- http://localhost:8000 (or port 8000 in Codespaces) shows a table of 5 contests.
- `php artisan test` ends with every test passing.

## Getting stuck

| Problem | Fix |
|---|---|
| Port 8000 is already in use | Docker: change `"8000:8000"` to `"8001:8000"` in `docker-compose.yml`. PHP: run `php artisan serve --port=8001`. Then use port 8001. |
| `could not find driver` | Your PHP has no SQLite driver. Install your system's `php-sqlite3` package (or equivalent), or use Docker. |
| Codespaces: VS Code's built-in preview shows a blank page | Open the app in a normal browser tab instead: **Ports** tab → globe icon next to port 8000. |
| The contest list is empty | Run `composer reset` to recreate the sample data. |
| Something else | Reply to your interview email with what you tried and the exact error. |

## About the app

Radio and TV stations run contests. Listeners enter through a JSON API, each entry is passed on to
the contest sponsor's CRM, and when a contest ends someone wins a prize. It's small on purpose:
you can read the whole thing in about 5 minutes.

```
app/Models/                       Station, Contest, Entry
app/Http/Controllers/Api/         ContestController, EntryController
app/Http/Requests/                StoreEntryRequest (validation for new entries)
app/Http/Resources/               JSON shape of the API responses
app/Services/SponsorCrm.php       The (simulated, slow) third-party sponsor CRM
database/migrations/              Schema
database/seeders/                 Sample data
resources/views/                  The homepage
routes/                           Web and API routes
tests/                            Feature and unit tests
```

### Trying the API

```bash
curl http://localhost:8000/api/contests
curl http://localhost:8000/api/contests/1

curl -X POST http://localhost:8000/api/contests/1/entries \
     -H 'Accept: application/json' -H 'Content-Type: application/json' \
     -d '{"name": "Jane Listener", "email": "jane@example.com"}'
```

### Useful commands

| Command | What it does |
|---|---|
| `php artisan test` | Run the test suite |
| `composer reset` | Wipe the database and recreate the sample data |
| `php artisan route:list --except-vendor` | List every route |
| `php artisan queue:work` | Process queued jobs |

Set `DB_LOG_QUERIES=true` in `.env` to write every SQL query to `storage/logs/laravel.log`.
