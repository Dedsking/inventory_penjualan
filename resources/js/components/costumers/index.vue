<template>
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-12">
                <div class="card mt">
                    <div class="card-header">
                        <h3 class="card-title">Data Customer</h3>
                        <div class="card-tools">
                            <button
                                type="button"
                                class="btn btn-primary btn-sm"
                                data-bs-toggle="modal"
                                @click="showModal"
                            >
                                Tambah data
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Diskon</th>
                                        <th>Tipe Diskon</th>
                                        <th>KTP</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tr
                                        v-for="costumer in costumers"
                                        :key="costumer.id"
                                    >
                                        <td>{{ costumer.nama }}</td>
                                        <td>{{ costumer.contact }}</td>
                                        <td>{{ costumer.email }}</td>
                                        <td>{{ costumer.alamat }}</td>
                                        <td>{{ costumer.diskon }}</td>
                                        <td>{{ costumer.tipe_diskon }}</td>
                                        <td></td>
                                        <td>
                                            <a
                                                href="#"
                                                @click="showModalEdit(costumer)"
                                                ><i
                                                    class="fa-solid fa-pen-to-square"
                                                ></i
                                            ></a>
                                            |
                                            <a
                                                href="#"
                                                @click="deleteData(costumer.id)"
                                                ><i
                                                    class="fa-solid fa-trash"
                                                ></i
                                            ></a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div
            class="modal fade"
            id="modalTambah"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="modalTambah1"
                            v-show="!statusmodal"
                        >
                            Tambah Costumer
                        </h5>
                        <h5
                            class="modal-title"
                            id="modalTambah1"
                            v-show="statusmodal"
                        >
                            Ubah Costumer
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <form
                        @submit.prevent="
                            statusmodal ? ubahData() : simpanData()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input
                                    type="text"
                                    v-model="form.nama"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('nama'),
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="nama"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <label for="">Contact</label>
                                <input
                                    type="text"
                                    v-model="form.contact"
                                    class="form-control"
                                    :class="{
                                        'is-invalid':
                                            form.errors.has('contact'),
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="contact"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input
                                    type="email"
                                    v-model="form.email"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('email'),
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="email"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea
                                    v-model="form.alamat"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('alamat'),
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="alamat"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <label for="">Diskon</label>
                                <input
                                    type="number"
                                    v-model="form.diskon"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('diskon'),
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="diskon"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <label for="">Tipe Diskon</label>
                                <select
                                    name="tipe_diskon"
                                    v-model="form.tipe_diskon"
                                    class="form-control"
                                    :class="{
                                        'is-invalid':
                                            form.errors.has('tipe_diskon'),
                                    }"
                                >
                                    <option value>Pilih Tipe Diskon</option>
                                    <option value="Presentase">
                                        Presentase
                                    </option>
                                    <option value="Fix-diskon">
                                        Fix Diskon
                                    </option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="tipe_diskon"
                                ></has-error>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label"
                                    >Ktp</label
                                >
                                <input
                                    class="form-control form-control"
                                    id="formFile"
                                    type="file"
                                />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >
                                Close
                            </button>
                            <button
                                type="submit"
                                class="btn btn-primary"
                                :disabled="disabled"
                                v-show="!statusmodal"
                            >
                                <i
                                    v-show="loading"
                                    class="fa fa-spinner fa-spin"
                                ></i>
                                Tambah
                            </button>
                            <button
                                type="submit"
                                class="btn btn-success"
                                :disabled="disabled"
                                v-show="statusmodal"
                            >
                                <i
                                    v-show="loading"
                                    class="fa fa-spinner fa-spin"
                                ></i>
                                Ubah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import $ from "jquery/src/jquery.js";
export default {
    data() {
        return {
            loading: false,
            disabled: false,
            statusmodal: false,
            costumers: {},
            form: new Form({
                id: "",
                nama: "",
                alamat: "",
                contact: "",
                email: "",
                diskon: "",
                tipe_diskon: "",
            }),
        };
    },
    methods: {
        showModal() {
            this.statusmodal = false;
            this.form.reset();
            $("#modalTambah").modal("show");
        },
        showModalEdit(costumer) {
            this.statusmodal = true;
            this.form.reset();
            $("#modalTambah").modal("show");
            this.form.fill(costumer);
        },
        loadData() {
            this.$Progress.start();
            axios
                .get("/api/costumer")
                .then(({ data }) => (this.costumers = data));
            this.$Progress.finish();
        },
        simpanData() {
            this.form.post("/api/costumer").then(() => {
                Fire.$emit("refreshData");
                $("#modalTambah").modal("hide");
                Toast.fire({
                    icon: "success",
                    title: "Data Berasil tersimpan",
                });
            });
        },
        ubahData() {
            this.$Progress.start();
            this.loading = true;
            this.disabled = true;
            this.form
                .put("/api/costumer/" + this.form.id)
                .then(() => {
                    Fire.$emit("refreshData");
                    // this.resetForm();
                    $("#modalTambah").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Data Berasil terupdate",
                    });
                    this.$Progress.finish();
                    this.loading = false;
                    this.disabled = false;
                })
                .catch(() => {
                    this.$Progress.fail();
                    this.loading = false;
                    this.disabled = false;
                });
        },
        // resetForm() {
        //     this.form.reset();
        // },
        deleteData(id) {
            Swal.fire({
                title: "Anda yakin ingin menghapus data ini ?",
                text: "Klik batal untuk membatalkan",
                icon: "Warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.value) {
                    this.form
                        .delete("api/costumer/" + id)
                        .then(() => {
                            Swal.fire(
                                "Terhapus!",
                                "Data anda telah terhapus.",
                                "success"
                            );
                            Fire.$emit("refreshData");
                        })
                        .catch(() => {
                            Swal.fire(
                                "Gagal!",
                                "Data anda gagal terhapus.",
                                "warning"
                            );
                        });
                }
            });
        },
    },
    created() {
        this.loadData();
        Fire.$on("refreshData", () => {
            this.loadData();
        });
    },
};
</script>
