# General
A Plugin for PocketMine-MP Software for get Information from Host Like Ram, CPU, Disk Space.</br></br>Usually this plugin is used for  Check if Pterodactyl or Host Panel is Fake Ram or Not.

## Commands
You can use commands `/gethostinfo` or `/hostinfo` Only Player with permission `gethostinfo.cmd` can use the commands!

## Config
``` YAML

# Available Tags
# RAM
# {total_ram} Get Total Used Ram
# {available_ram} Get Available Ram
# CPU
# {total_cpu_load} Get Total CPU Loaded
# {cpu_count} Get Count of CPU
# DISK SPACE
# {total_space} Get Total DiskSpace
# {available_space} Get Total Available DiskSpace
# OTHERS
# {line} use for New line you can use \n
message: "§aYour Host Statistics{line}{line}§aRAM Information{line}§fAvailable RAM: §a{available_ram} §f/ §a{total_ram}{line}{line}§aCPU Information{line}§fCPU: §a{cpu_count}{line}§fLoad: §a{total_cpu_load}{line}{line}§aDiskSpace Information{line}§fAvailable DiskSpace: §a{available_space} §f/ §a{total_space}"

```

## Screenshot
![Screenshot](https://raw.githubusercontent.com/XanderID/HostInfoGetter/main/.assets/screenshot.jpg)

## Additional Notes
- If you find bugs or want to give suggestions, please visit [here](https://github.com/XanderID/HostInfoGetter/issues)
- Icons By [icons8.com](https://icons8.com)