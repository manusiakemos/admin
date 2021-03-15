export default {
    data() {
        return {
            headerUpload: {
                headers: {'Content-Type': 'multipart/form-data'}
            },
            showMyModal: false,
            options1:[
                {text:'Ya', value:1},
                {text:'Tidak', value:0}
            ]
        };
    },
    created(){
        this.screen_large = screen.width > 400;
    },
    watch: {
        showMyModal(value){
            this.errors = [];
            this.file = [];
            this.image = [];
        }
    },
    methods: {
        toggleSidebar() {
            this.$store.commit("SET_SIDEBAR");
        },
        printPdf(orientation = 'portrait', target = 'print') {
            var localOptions;
            if (orientation === 'landscape') {
                localOptions = {
                    styles: [
                        '/css/app.css',
                        '/css/landscape.css'
                    ]
                };
            } else {
                localOptions = {
                    styles: [
                        '/css/app.css',
                    ]
                };
            }
            this.$htmlToPaper(`${target}`, localOptions);
        },
        rupiah(value) {
            var number = parseFloat(value);
            var r = new Intl.NumberFormat().format(number);
            return "Rp. " + r;
        },
        objectLength(obj) {
            var key, len = 0;
            for (key in obj) {
                len += Number(obj.hasOwnProperty(key));
            }
            return len;
        },
        tanggal(t) {
            var date = new Date(t);
            var tahun = date.getFullYear();
            var bulan = date.getMonth();
            var tgl = date.getDate();
            var hari = date.getDay();
            var jam = date.getHours();
            var menit = date.getMinutes();
            var detik = date.getSeconds();
            switch (hari) {
                case 0:
                    hari = "Minggu";
                    break;
                case 1:
                    hari = "Senin";
                    break;
                case 2:
                    hari = "Selasa";
                    break;
                case 3:
                    hari = "Rabu";
                    break;
                case 4:
                    hari = "Kamis";
                    break;
                case 5:
                    hari = "Jum'at";
                    break;
                case 6:
                    hari = "Sabtu";
                    break;
            }
            switch (bulan) {
                case 0:
                    bulan = "Januari";
                    break;
                case 1:
                    bulan = "Februari";
                    break;
                case 2:
                    bulan = "Maret";
                    break;
                case 3:
                    bulan = "April";
                    break;
                case 4:
                    bulan = "Mei";
                    break;
                case 5:
                    bulan = "Juni";
                    break;
                case 6:
                    bulan = "Juli";
                    break;
                case 7:
                    bulan = "Agustus";
                    break;
                case 8:
                    bulan = "September";
                    break;
                case 9:
                    bulan = "Oktober";
                    break;
                case 10:
                    bulan = "November";
                    break;
                case 11:
                    bulan = "Desember";
                    break;
            }
            var tampilTanggal = tgl + " " + bulan + " " + tahun;
            // var tampilWaktu = "Jam: " + jam + ":" + menit + ":" + detik;
            return tampilTanggal;
        },
        makeFormData(data) {
            var formData = new FormData();
            for (var key in data) {
                if(data[key] != null ||  data[key] != "null"){
                    formData.append(key, data[key]);
                }
            }
            return formData;
        },
        logout(){
            this.axios.post('/logout').then((res)=>{
                this.$router.push({name:'Login'});
                this.$store.commit("SET_SIDEBAR");
            });
        },
    },
    computed: {
        user() {
            return this.$store.state.user;
        },
        activeSidebar: {
            get() {
                return this.$store.state.activeSidebar;
            },
            set() {
                this.$store.commit('SET_SIDEBAR');
            }
        }
    }
};
