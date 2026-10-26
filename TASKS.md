# Task 0: the contest page

This is the task for your first interview, about 20 minutes. You'll do it during the call while
sharing your screen, so please read it beforehand but **don't start it before the call**.

- Talk us through what you're doing as you go. We care about how you work, not only about finishing.
- Use your normal editor and any documentation you like (laravel.com/docs, `php artisan help`, etc.).
  **No AI assistants**, please.
- Later interviews have different tasks, which you'll get during those calls.

---

**Before the call:** get the app running on your own computer as the [README](README.md) explains
(Codespaces only as a fallback). When the
call starts, have the homepage (the list of contests) open in your browser and be ready to share
your screen.

During the call, build this:

1. On the homepage, make each **contest title a link** to a new page at `/contests/{id}`
   (for example, `/contests/1`).
2. At the top of that page, show a **"← Back to all contests"** link that goes back to the homepage.
3. Show the **contest title as the main heading**, and under it the **station name**, the **prize**
   and the **status** (open, ended or upcoming).
4. Under a heading **"Latest entries"**, list the **5 most recent entries, newest first**. For each,
   show the listener's **name** and **how long ago they entered** (for example, "2 minutes ago").
   **Do not show email addresses or phone numbers**: listeners' contact details are private.
5. If a contest has no entries, show the text **"No entries yet."** instead of the list.
6. A contest that doesn't exist, such as `/contests/999`, must show a **404 Not Found** page,
   not an error.

When you're done, show it working:

- Enter the "Taylor Swift Ticket Drop" contest (#1) with **your own name**, using the `curl` command
  shown on the homepage or any HTTP client you like. Refresh the contest page: your name should be at the top.
- Open the "Holiday Shopping Spree" contest (#5), which hasn't started yet and shows "No entries yet."
- Open `/contests/999` to show the 404 page.
- Run `php artisan test` to show the existing tests still pass. A test for your page is a bonus.

How it looks is up to you; plain is fine.
