# PHP2Shell Local Research Lab

A loopback-only Docker lab for studying CVE-2026-109618 with an Onda Living PHP storefront. The website uses the same source files in a vulnerable and a patched PHP container. A separate debug container supports the local, white-box RCE demonstration.

## Project layout

```text
php2shell/
├── README.md
├── compose.yaml                 # PHP 8.4.26 and 8.4.27 comparison
├── website/
│   ├── index.php
│   └── style.css
└── exploit/
    ├── exp.py                   # Local lab driver and shell interface
    ├── probe_reclaim.py         # Loopback HTTP request generator
    ├── gdb-calibrate.py         # Local debugger calibration
    ├── relay.php                # Local shell relay
    ├── compose.yaml
    ├── Dockerfile
    ├── php.ini
    └── mpm_prefork.conf
```

## Requirements

- Docker Desktop or Docker Engine with Compose v2
- Python 3.10 or later

## Run the website

From this directory in PowerShell:

```powershell
docker compose up -d
```

Open `http://127.0.0.1:18080/` for PHP 8.4.26 or `http://127.0.0.1:18081/` for the patched PHP 8.4.27 comparison. Both serve `website/` read-only.

## Run the local reproduction

The driver builds and starts its pinned PHP 8.2.6 debug container automatically. It calibrates addresses with GDB, sends the local test request, verifies execution as `www-data`, then restores the storefront at `http://127.0.0.1:18085/`.

```powershell
python .\exploit\exp.py --shell-check
```

For the interactive local shell, run `python .\exploit\exp.py`. Commands appear under a `current/path >` prompt; enter `exit` to finish. For the file-based proof, run `python .\exploit\exp.py --proof`. Results are written to `exploit/evidence/`, which is excluded from Git.

Stop the containers with:

```powershell
docker compose down
docker compose -f .\exploit\compose.yaml down
```

## Scope and attribution

This is a controlled, localhost-only reproduction. `exp.py` takes no remote target and relies on local GDB and process mappings for address calibration. It does not demonstrate an HTTP ASLR leak or a general exploit against arbitrary PHP installations. The PHP 8.4.26/8.4.27 pair is for patch comparison; the RCE demonstration was verified in the pinned PHP 8.2.6 debug environment.

The reproduction is adapted from [lzz0403's local CVE-2026-109618 PoC](https://github.com/lzz0403/CVE-2026-109618-PHP2Shell-poc). See the [official PHP advisory](https://github.com/php/php-src/security/advisories/GHSA-w8hw-w9fx-j79w) for affected versions and remediation.
