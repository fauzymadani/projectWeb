# Menggunakan image dasar yang sesuai
FROM nginx:latest

# Mengatur direktori kerja di dalam container
WORKDIR /usr/share/nginx/html

# Menyalin semua file dari host ke dalam container
COPY . .

# Menentukan port yang akan digunakan
EXPOSE 8081