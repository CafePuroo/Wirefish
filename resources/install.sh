#@Authores: Márcio Moda, João Manoel, Gabriel Pereira, Patrick Matos e Brener Picanço
#
#Arquivo para instalação de pacotes em sh
#
#!/bin/bash

sudo apt update

#Instalando os pacotes necessários do LAMMP
sudo apt install tshark default-mysql-server default-mysql-client apache php libapache2-mod-php php-mysql -y

#Liberando o acesso do Apache pelo FW na porta 80
sudo ufw app list
sudo ufw allow in "Apache"

#Modificando as configs do mysql

sudo mysql
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';
exit

sudo mysql_secure_installation
