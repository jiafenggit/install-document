
###postgres 安装
<pre>
./configure
gmake
su
gmake install
adduser postgres
mkdir /usr/local/pgsql/data
chown postgres /usr/local/pgsql/data
su - postgres
/usr/local/pgsql/bin/initdb -D /usr/local/pgsql/data
/usr/local/pgsql/bin/postgres -D /usr/local/pgsql/data >logfile 2>&1 &
/usr/local/pgsql/bin/createdb test
/usr/local/pgsql/bin/psql test


Success. You can now start the database server using:

    /usr/local/pgsql/bin/postgres -D /www/postgres/data/
or
    /usr/local/pgsql/bin/pg_ctl -D /www/postgres/data/ -l logfile start

</pre>