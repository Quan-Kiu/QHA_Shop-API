const uploadPhoto = async (file) => {
    const formData = new FormData();
    formData.append("file", file);
    formData.append("upload_preset", "mfym3il5");
    try {
        const res = await axios.post(
            "https://api.cloudinary.com/v1_1/quankiu/upload",
            formData
        );
        return res.data.url;
    } catch (error) {
        return false;
    }
};
const uploadPhotos = async (files) => {
    const imagesUrl = [];
    for (let index = 0; index < files.length; index++) {
        const formData = new FormData();
        formData.append("file", files[index]);
        formData.append("upload_preset", "mfym3il5");
        try {
            const res = await axios.post(
                "https://api.cloudinary.com/v1_1/quankiu/upload",
                formData
            );
            imagesUrl.push(res.data.url);
        } catch (error) {
            return false;
        }
    }
    return imagesUrl;
};
