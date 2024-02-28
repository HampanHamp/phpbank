PHPBANK - Version 1.0

NOTE: This is a beta version. It wouldn't be very wise to start running a real economy on it just yet, you never know what could go wrong. Don't say i didn't warn you!

CHANGES FROM BETA 2:
- Transactions listings are now chronological
- Final Release preparations

###################

  1. Requirements
  2. Installation
  3. Admin CP
  4. More help
  5. Disclaimer

###################

!! IMPORTANT NOTICE !!

Should you encounter any error that is not in the standard error layout of PHPBank, then you have probably discovered a programming error. If something else goes wrong, like balances going up and down out of nowhere, or something similar, those are also probably programming errors.
PLEASE CONTACT THE DEVELOPER WHEN YOU THINK YOU HAVE ENCOUNTERED A PROGRAMMING ERROR.
PHPBank will occasionally be updated; these updates will just be a bunch of files that you upload to the PHPBank location on your server, so that the old files are overwritten. If the update contains changes to the database structure, an update.php file will be supplied.

That said, enjoy PHPBank!

###################

1. REQUIREMENTS
PHPBank requires:
	- PHP 4. It was programmed in PHP 4.2.3, but will probably work with older versions as well.
	- MySQL 3 or 4. It was programmed in MYSQL 3.23.32 which is a fairly old version, so this shouldn't be a problem.
	- Make sure that PHP supports the mail(); function correctly! Lycos for one limits the capabilities of mail(); which could give problems.



2. INSTALLATION
Installing PHPBank is pretty easy and you shouldn't have any problems if you stick to the instructions. Here's how to install it correctly:

- Open the config file in notepad or another editor. Edit the values with your own information. You can probably find this info on your host's website or in the email you got from your host.
	your_password = the MySQL password
	your_host = the hostserver if it isn't mentioned everywhere, this will probably be localhost.
	your_username = the MySQL username
	your_database = the MySQL database you want to install PHPBank to.

- Upload all files to the desired location. You don't have to upload this readme file, of course, but it won't do any harm. It's best to upload PHPBank into a subfolder, /phpbank perhaps, but this is not required.

- Surf to install.php with your browser. Install.php is wherever you uploaded PHPBank to. If you uploaded into /phpbank for example, it will be at www.yourdomain.com/phpbank/install.php

- Follow the instructions and enter the necessary information.

- If you encounter any MySQL errors, the values you entered in the config.php file are probably incorrect. You might have problems reinstalling PHPBank after such errors; consult the developer if necessary.

- That's it, PHPBank is ready for use. You might want to mess with the layout to fit your nation's theme first, though.



3. ADMIN CP
The admin control pannel has 4 different sections:
	- Layout
	here you can edit the layout of PHPBank. Be careful; if you manage to make everything unreadable, the admin control pannel will be affected as well! The colors are HTML hex values. A decent graphics editing program (for example Paint Shop Pro) will show the hex value for each color you select somewhere.

	- Other information
	This is where you edit the bank information, like the nation's name, currency symbol,... things you entered during installation. You can also edit the url for the top image.

	- Account activation
	Accounts that are awaiting activation by you will be listed here. You can either activate or delete them.
	
	- Force a transaction
	A forced transaction does not have to be accepted by either of the participants. This is useful for fines or paying wages. Try not to make mistakes with it though, some people might not appreciate that ;)



4. MORE HELP
if you need help concerning the installation of PHPBank, or really anything else, you can always contact the developer at sanderdieleman [at] hotmail [dot] com, or on MSN (with that address), ICQ (104572163) or AOL IM (Sander063002).



5. DISCLAIMER
By using PHPBank you and all account holders agree to the following:
First of all, I can NOT be held responsible for anything that goes wrong. PHPBank is not perfect, I know that and you know that, or at least you should.
You may edit the code if you are experienced, but you may not spread edited versions of PHPBank. You may however spread copies of PHPBank that are not edited. I am not able to take real legal actions against you if you don't abide by this rule, but rest assured that I will take micronational legal actions against you.

In return for using PHPBank, I ask that you give me the link to your copy, so I can see it in action. Just drop it in sanderdieleman [at] hotmail [dot] com, thanks :)

