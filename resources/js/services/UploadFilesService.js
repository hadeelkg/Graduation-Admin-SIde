import store from '../store/index'
import http from '../utils/axios/admin';

class UploadFilesService {
    upload(file, onUploadProgress) {
        let formData = new FormData();

        formData.append("file", file);

        return http.post("api/admin/upload/daily/content", formData, {
            headers: {
                "Content-Type": "multipart/form-data"
            },
            onUploadProgress
        });
    }

    getFiles() {

        store.dispatch('admin/fetchDailyContentList').then((response) => {
            return response.data;
        })

    }
}

export default new UploadFilesService();