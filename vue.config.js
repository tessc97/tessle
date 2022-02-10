configureWebpack: config => {
    return {
        title: "Tessle",
        resolve: {
            alias: {
                '@': resolve('src')
            }
        },
        plugins: []
    }
}