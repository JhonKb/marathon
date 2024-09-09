
# Marathon

This project is the result of a scientific study on health and sport, with the creation of software capable of managing street races using QrCodes.

## User Stacks

- [Laravel](https://laravel.com/docs/11.x)
- [LiveWire](https://laravel-livewire.com/docs/2.x/quickstart)
- [TailwindCSS](https://tailwindcss.com/docs)
- [FilamentPHP](https://filamentphp.com/docs/3.x)
- [NodeJS](https://nodejs.org/docs/latest/api/)
- [Docker](https://docs.docker.com/)

## Starting

This project mainly uses Docker to manage containers related to the development environment. Therefore, the first step is to install it on your machine.

> To install, follow the documentation:<br>
> - Docker Desktop ([Windows](https://docs.docker.com/desktop/install/windows-install/)/[macOS](https://docs.docker.com/desktop/install/mac-install/)/[Linux](https://docs.docker.com/desktop/install/linux/))<br>
> - Docker Engine ([Linux](https://docs.docker.com/engine/install/))

---

After installing and configuring Docker follow these steps:

> These steps are based on the Linux OS and Laravel Sail

Clone repository
```bash
git clone https://github.com/JhonKb/marathon project-name
```

Enter the project directory
```bash
cd project-name
```

Copy the .env
```bash
cp .env.example .env
```

Up and Build the containers
```bash
docker-compose up --build -d
```
> This process may take a while. Wait until the end.<br>
> In case of error, check the ports in [docker-compose.yml](docker-compose.yml) and change them if necessary

Generate the key
```bash
./vendor/bin/sail art key:generate
```

Run database migrations and seeders(optional)
```bash
./vendor/bin/sail art migrate --seed
```

## Authors

- [@JhonKb](https://www.github.com/JhonKb)
- [@davi1sousa](https://github.com/davi1sousa)
- [@crysmar1](https://github.com/crysmar1)
- [@markame](https://github.com/markame)
