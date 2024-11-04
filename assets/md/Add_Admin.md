To add an admin to the `Admins` table, you can insert a new record with SQL. Here’s how you can do it securely, using a password hash.

### Step 1: Generate a Hashed Password

For security, it’s best to store a hashed password in the database. You can generate a hashed password using PHP like this:

```php
<?php
$plainPassword = "your_password_here";
$hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);
echo $hashedPassword;
?>
```

- Run this PHP code locally to get a hashed version of your password.
- Copy the generated hash.

### Step 2: Insert Admin Data in phpMyAdmin

Now, use phpMyAdmin to add the new admin with the hashed password.

1. Open **phpMyAdmin** and go to the `event_management` database.
2. Navigate to the **SQL** tab.
3. Run the following SQL command, replacing `"Admin Name"`, `"admin@example.com"`, and `"<hashed_password_here>"` with the actual values:

   ```sql
   INSERT INTO Admins (admin_name, admin_email, admin_password)
   VALUES ('Admin Name', 'admin@example.com', '<hashed_password_here>');
   ```

For example:

```sql
INSERT INTO Admins (admin_name, admin_email, admin_password)
VALUES ('John Doe', 'admin@example.com', '$2y$10$examplehashedpassword...');
```

4. Click **Go** to execute. This will insert the admin data with the hashed password, ensuring it’s secure in the database.

Let me know once this is complete, and we can move forward!