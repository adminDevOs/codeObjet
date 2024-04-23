Vagrant.configure("2") do |config|
  # Utilisation de la box Ubuntu 20.04 LTS
  config.vm.box = "debian/buster64"
  
  # Configuration de la machine virtuelle
  config.vm.provider "virtualbox" do |vb|
    vb.memory = "2048"
    vb.cpus = 2
  end

  # Configuration de la provision
  config.vm.provision "shell", inline: <<-SHELL
    # Mise à jour du système
    sudo apt-get update
    sudo apt-get upgrade -y
    
    # Installation de Git
    sudo apt-get install git -y
    
    # Installation de Docker
    sudo apt-get install docker.io -y
    sudo usermod -aG docker vagrant
    
    # Installation de Docker Compose
    sudo apt-get install docker-compose -y
    
    # Installation de Python
    sudo apt-get install python3 -y
    
    # Installation de pip (gestionnaire de paquets Python)
    sudo apt-get install python3-pip -y
    
    # Installation d'Ansible
    sudo apt-get install ansible -y
    
    # Installation de Jenkins
    wget -q -O - https://pkg.jenkins.io/debian-stable/jenkins.io.key | sudo apt-key add -
    sudo sh -c 'echo deb https://pkg.jenkins.io/debian-stable binary/ > /etc/apt/sources.list.d/jenkins.list'
    sudo apt-get update
    sudo apt-get install jenkins -y
  SHELL
end

//Une fois que vous avez ajouté cette configuration à votre Vagrantfile, exécutez vagrant up pour démarrer 