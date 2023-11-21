import os

def list_files_in_directory(directory):
    file_list = []
    for root, dirs, files in os.walk(directory):
        for file in files:
            if file != 'sitemap.xml':
                file_list.append(os.path.relpath(os.path.join(root, file), directory))
    return file_list

def create_sitemap_xml(domain, output_file):
    current_directory = os.getcwd()  # Obtém o diretório atual onde o script está sendo executado
    files = list_files_in_directory(current_directory)
    
    with open(output_file, 'w') as f:
        f.write('<?xml version="1.0" encoding="UTF-8"?>\n')
        f.write('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">\n')
        
        for file in files:
            url = os.path.join(domain, file).replace("\\", "/")
            f.write('  <url>\n')
            f.write(f'    <loc>{url}</loc>\n')
            f.write('  </url>\n')
        
        f.write('</urlset>\n')

if __name__ == "__main__":
    domain = input("Digite o domínio do site (por exemplo, https://www.exemplo.com): ")
    output_file_path = "sitemap.xml"
    
    create_sitemap_xml(domain, output_file_path)
    print(f"Sitemap gerado com sucesso em {output_file_path}")
