welcome to project Image Encryption Using AES Algorthim implementaion

To run the code successfully you must make sure for the following:
1.install GD Library throgh C:\xampp\php\php.ini
|For Windows|, you'll need to enable the GD extension in PHP.
Locate the php.ini file in your PHP installation directory, and uncomment 
(remove the semicolon ; at the beginning) the following line:
;extension=gd
Save the changes and restart your web server.

|For Ubuntu or Debian|,Open a terminal and run the following command to install the GD library:
sudo apt-get install php-gd

Restart your web server to apply the changes:
sudo service apache2 restart

|For CentOS or Fedora|,Open a terminal and run the following command to install the GD library:
sudo yum install php-gd

Restart your web server to apply the changes:
sudo service httpd restart

2.increase the size of Memory Limit inside the file C:\xampp\php\php.ini 
note: the path of php.ini may vary in your device.
