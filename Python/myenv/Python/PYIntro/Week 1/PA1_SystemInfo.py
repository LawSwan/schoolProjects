import platform
import psutil

def get_system_info():
    system_info = {
        "Manufacturer": "Apple",
        "Model": platform.machine(),
        "Name": platform.node(),
        "NumberOfProcessors": psutil.cpu_count(logical=False),
        "SystemType": platform.system(),
        "SystemFamily": "Macintosh"
    }
    return system_info

def print_system_info(system_info):
    print(f"Manufacturer: {system_info['Manufacturer']}")
    print(f"Model: {system_info['Model']}")
    print(f"Name: {system_info['Name']}")
    print(f"NumberOfProcessors: {system_info['NumberOfProcessors']}")
    print(f"SystemType: {system_info['SystemType']}")
    print(f"SystemFamily: {system_info['SystemFamily']}")

if __name__ == "__main__":
    info = get_system_info()
    print_system_info(info)