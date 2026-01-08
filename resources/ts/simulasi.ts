// Simulasi data untuk EduTrack menggunakan TypeScript

interface Mahasiswa {
    id: number;
    nama: string;
    email: string;
    nim: string;
}

interface Kursus {
    id: number;
    nama_kursus: string;
    deskripsi: string;
}

interface Nilai {
    tugas: number[];
    ujian: number[];
}

interface Performa {
    mahasiswa: Mahasiswa;
    kursus: Kursus;
    nilai: Nilai;
    nilai_final: number;
    grade: string;
}

// Fungsi untuk menghitung nilai final dengan TypeScript
function hitungNilaiFinal(nilai: Nilai): number {
    const avgTugas =
        nilai.tugas.length > 0
            ? nilai.tugas.reduce((a, b) => a + b) / nilai.tugas.length
            : 0;
    const avgUjian =
        nilai.ujian.length > 0
            ? nilai.ujian.reduce((a, b) => a + b) / nilai.ujian.length
            : 0;
    return Math.round((avgTugas * 0.3 + avgUjian * 0.7) * 100) / 100;
}

// Fungsi untuk tentukan grade
function tentukanGrade(nilaiFinal: number): string {
    if (nilaiFinal >= 90) return "Excellent";
    if (nilaiFinal >= 80) return "Good";
    if (nilaiFinal >= 70) return "Satisfactory";
    if (nilaiFinal >= 60) return "Needs Improvement";
    return "Fail";
}

// Data simulasi
const mahasiswas: Mahasiswa[] = [
    { id: 1, nama: "Samsul Hakim", email: "samsul@example.com", nim: "12345" },
    { id: 2, nama: "Ahmad Fauzi", email: "ahmad@example.com", nim: "12346" },
];

const kursuses: Kursus[] = [
    {
        id: 1,
        nama_kursus: "Web Developer",
        deskripsi: "Belajar web development",
    },
    { id: 2, nama_kursus: "Data Science", deskripsi: "Belajar data analysis" },
];

// Simulasi performa
const performas: Performa[] = [
    {
        mahasiswa: mahasiswas[0],
        kursus: kursuses[0],
        nilai: { tugas: [80, 85], ujian: [90, 95] },
        nilai_final: 0, // akan dihitung
        grade: "",
    },
];

// Hitung performa
performas.forEach((p) => {
    p.nilai_final = hitungNilaiFinal(p.nilai);
    p.grade = tentukanGrade(p.nilai_final);
});

console.log("Data Simulasi Performa:", performas);

export { mahasiswas, kursuses, performas, hitungNilaiFinal, tentukanGrade };
