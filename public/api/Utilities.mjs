const call = (url) => {
    const promise = fetch(url);
    return promise.then(response => response.json());
};

export{
    call
};