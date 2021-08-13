# Instructions
*This script was written to build a proxy list of Surfshark service servers.* \
*Change Host2Ip for bypass censorship* \
__To work with the script, you need a password and a port from the account on the Surfshark site__
### SurfShark: An introduction for users
Surfshark proves its worth with a large collection of privacy tools, an excellent app, and unlimited device connections.\
Everythings you should know are at [Official Page](https://surfshark.com/features).
## Installation & Usage
__You need to install `php` before this__
```
git clone https://github.com/Incognito-Coder/SurfSocks.git
cd SurfSocks
php app.php
```
### Main Features
![Screenshot](https://github.com/Incognito-Coder/SurfSocks/blob/main/img/main.png "Application")
1. Generate fresh Shadowsocks servers list.
2. Update old hostname to ip address
3. Create Clash config from surfshark servers.
## REQUEST Mode
- Script now supports REST API mode.
- Request as `POST`
### Body Parameters
- **POST DATA to:** `app.php`

| Info  | Key  | Type  |
|---|---|---|
| command method  | create/clash  | string  |
|  file name |  name | string  |
| account password  |  pass | varchar  |
| port number  |  port | integer  |
# Credits
Developer : Incognito Coder \
Thanks : MrLinux [@VPNFolder](https://telegram.me/vpnfolder) \
and thanks to all who helped me for improving this little project. \
if you enjoy my content,consider to buy me a coffee here:
1. Donate [ZarinPal](https://zarinp.al/@incognito)
2. BTC : `bc1q62kaxyt2lyhcans6fr6u39qzndkydrz2uzae9a`