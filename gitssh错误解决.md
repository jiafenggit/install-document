(gnome-ssh-askpass:3422): Gtk-WARNING **: cannot open display:
解决办法


命令：unset SSH_ASKPASS

echo 'unset SSH_ASKPASS' >> ~/.bashrc && source ~/.bashrc