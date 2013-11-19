Github Auto Pull
===============================================================================

This script is based on the post by [Jeffery Way](http://jeffrey-way.com/) on 
Nettuts+,  [The Perfect Workflow, with Git, GitHub, and SSH](http://net.tutsplus.com/tutorials/other/the-perfect-workflow-with-git-github-and-ssh/).

Github Auto Pull aims to provide as secure a way as possible of having your 
project auto pull when you push a commit to Github.

GitHub hooks are slow to execute. If you need an instantaneous response, post to the url in a script that is executed in a git hook.

Installing
-------------------------------------------------------------------------------

1. Copy the contents of `github-pull.php` into a file on your server, you can keep the original name but for increase security you should rename it.

2. Now enter the URL of your server including the path to the `github-pull.php` file (or what ever you called it) and append it with the querystring `?passgen=PASSWORD` (change PASSWORD to a random string). This will generate the salt and password for your file as well as give you the url for the service hook… which should be hany!

3. Copy the contents of the first text box and paste that into the file (should be lines 4 and 5) 

4. Copy the contents of the second text box and go to `https://github.com/USERNAME/PROJECT/admin/hooks` (changing USERNAME and PROJECT accordinly) and click on "Post-Receive URLs" and paste the contents into one of the empty boxes. Click "Update Settings".
   
   _or_
  
   Setup a git hook in your local git repo using this url.

5. Change the permissions of the file to `754`. This will allow your server to run the commands.

6. Modify the sudoers file (`visudo`) to give the apache user the right to act as the git owner to pull changes:

    ```
    Defaults:apache !requiretty
    apache ALL = (your-git-user) NOPASSWD: /usr/bin/git pull
    ```

7. All done.

Security
-------------------------------------------------------------------------------

Security as provided here is basic. There is MD5 encoding and the somewhat secure crypt() file. It just comes down to breaking a password. So make sure your password is sufficiently unguessable.

Further work is required to make this more robust in the cloud:

* To scale it, create SNS topic in AWS using the url provided in step (4) below and have all web servers subscribe to it. 

* Either change GitHub post-receive URLs to use SNS notification or modify git hook to send that notification to SNS. Sending notification requires access to AWS account credentials, providing another level of security.

* Lock down apache to only allow execution of that URL from SNS.

Options
-------------------------------------------------------------------------------

You can pass various options through the query string.

### Required

`update=...`
Pass phrase you set in install step 2


###Optional

`project=...` 
Give the project a name in the emails; "[PROJECT] ..."

`from=...`
Email user the post-pull emails is sent from; USER@github.com

`email=...`
Who the post-pull email should go to, if empty then no email is sent


-------------------------------------------------------------------------------
Github Auto Pull by [Neil Sweeney](http://wolfiezero.com/) is licensed under a 
[Creative Commons Attribution-ShareAlike 3.0 Unported License](http://creativecommons.org/licenses/by-sa/3.0/).
