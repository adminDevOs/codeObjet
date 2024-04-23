# -*- mode: ruby -*- 

# vi: set ft=ruby : 

Vagrant.configure("2") do |config|
  machines = [
    {
      :hostname => "machine1",
      :ip => "192.168.1.10",
      :box => "opensuse/Leap-15.3.x86_64",
      :ram => 2048,
      :cpu => 1
    },
    {
      :hostname => "machine2",
      :ip => "192.168.1.20",
      :box => "debian/bullseye64",
      :ram => 2048,
      :cpu => 2
    },
    {
      :hostname => "machine3",
      :ip => "192.168.1.30",
      :box => "almalinux/8",
      :ram => 2048,
      :cpu => 2
    }
  ]

  machines.each do |machine|
    config.vm.define machine[:hostname] do |node|
      node.vm.box = machine[:box]
      node.vm.hostname = machine[:hostname]
      node.vm.network "private_network", ip: machine[:ip]
      node.vm.provider "virtualbox" do |vb|
        vb.gui = false
        vb.memory = machine[:ram]
        vb.cpus = machine[:cpu]
      end
    end
  end
end


  
