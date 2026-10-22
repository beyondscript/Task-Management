<template>
    <div class="container not_found_container">
        <section class="not_found_card" aria-labelledby="not-found-title">
            <div class="not_found_content" style="align-items: center;">
                <img class="not_found_image" :src="'/images/404-not-found.webp'">
                <h1 id="not-found-title" style="text-align: center;">Page Not Found</h1>
                <p style="text-align: center;">The page you are looking for might have been removed or temporarily unavailable.</p>
                <a class="btn btn-primary not_found_home" href="/">
                    Go to home
                </a>
            </div>
        </section>
    </div>
</template>

<style scoped>
.not_found_container {
    max-width: fit-content;
}

.not_found_card {
    width: fit-content;
    background-color: var(--page_surface);
    border: 1px solid var(--page_border);
    border-radius: 28px;
    box-shadow: 0 24px 80px rgba(38, 26, 76, 0.12);
}

.not_found_visual {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 460px;
    padding: 48px 32px;
    overflow: hidden;
    background: radial-gradient(ellipse at center, #ffffff 0%, #f0ebfa 75%);
}

.not_found_image {
    display: block;
    width: min(360px, 100%);
    height: auto;
    object-fit: contain;
}

.not_found_content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    padding: 56px 44px;
}

.not_found_label {
    padding: 7px 12px;
    background-color: #f0ebff;
    border-radius: 20px;
    color: var(--page_primary);
    font-size: 12px;
    font-weight: 700;
}

.not_found_content h1 {
    margin: 20px 0 16px;
    color: var(--page_text);
    font-family: 'Segoe UI', system-ui, sans-serif;
    font-size: clamp(30px, 3vw, 42px);
    font-weight: 800;
    line-height: 1.12;
    letter-spacing: -1.2px;
}

.not_found_content > p {
    max-width: 360px;
    margin: 0 0 28px;
    color: var(--page_muted);
    font-size: 15px;
    line-height: 1.8;
}

.not_found_home {
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

@media (max-width: 767px) {
    .not_found_card {
        grid-template-columns: minmax(0, 1fr);
        border-radius: 24px;
    }

    .not_found_visual {
        min-height: 250px;
        padding: 28px 24px;
    }

    .not_found_image {
        width: min(280px, 100%);
    }

    .not_found_content {
        padding: 32px 24px;
    }

    .not_found_content > p {
        font-size: 14px;
    }
}
</style>
